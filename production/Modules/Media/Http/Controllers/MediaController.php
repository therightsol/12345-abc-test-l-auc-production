<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\Post;
use Modules\Media\Entities\PostStatus;
use Nwidart\Modules\Facades\Module;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;



class MediaController extends Controller
{

    // Check requried module
    public function __construct()
    {
        if (! $this->isModuleEnabled('post')){}
            //dd('Please enable post module first');

    }

    /**
     * Checks if given module is enabled
     *
     * @param $moduleName
     * @return bool
     */
    private function isModuleEnabled($moduleName)
    {
        $enabledModules = Module::enabled();

        foreach ($enabledModules as $module) {
            if (strtolower($module->name) === strtolower($moduleName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $paginate = 36, $page = false)
    {
        if ($page)
            $request['page'] = $page;


        $post_status = PostStatus::where('status_title', 'published')->get(['id']);

        if (! isset($post_status[0])){
            return '<p class="alert alert-danger">please add post publish status first</p>';
        }


        $selected_files = Post::where('post_type', 'attachment')
            ->where('post_status_id', $post_status[0]->id);


        $maxFileSize = ini_get('upload_max_filesize');
        $maxFileSize = str_replace('M', '', $maxFileSize);


        if ( $request->ajax() ){
            $selected_files = $selected_files->where('mime_type', 'like', 'image/%')->orderBy('id', 'desc')->paginate( $paginate );

            return view ('media::layoutfiles.embedd.view-page', compact('selected_files', 'maxFileSize'));

            //echo json_encode($selected_files);

        }else {
            $selected_files = $selected_files->orderBy('id', 'desc')->paginate( $paginate );
            return view('media::layoutfiles.index', compact('selected_files', 'maxFileSize'));

        }

    }

    // display form to add media
    public function add(Request $request){

        $maxFileSize = ini_get('upload_max_filesize');
        $maxFileSize = str_replace('M', '', $maxFileSize);

        return $request->ajax() ? view('media::layoutfiles.embedd.add-media', compact('maxFileSize'))
            : view('media::layoutfiles.add_media', compact('maxFileSize'));
    }


    /*public function all_media(Request $request, $dir = 'posts')
    {
        $dir = 'images/' . $dir;

        $file_lists = scandir( $dir );

        //get subset of file array
        $selected_files = array_slice($file_lists, 0, 80);



        $image_ext_arr = ['jpg', 'png', 'jpeg', 'ico'];


        $documents_ext_arr = ['pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx'];

        if ($selected_files[0] == '.')
            unset($selected_files[0]);

        if ($selected_files[1] == '..')
            unset($selected_files[1]);

//        $ext = pathinfo($file_lists[2], PATHINFO_EXTENSION);
//
//        return $ext;


        $selected_files = array_reverse($selected_files);


        if ( $request->ajax() ){
            return view ('admin.media.embedded-page', compact('selected_files', 'image_ext_arr', 'dir'));

            //echo json_encode($selected_files);

        }else {
            return view('admin.media.index', compact('selected_files', 'image_ext_arr', 'dir'));

        }



    }*/

    public function ajax_media($offset = 10, $quantity = 10)
    {

        $file_lists = scandir('images/posts');

        //get subset of file array
        $selected_files = array_slice($file_lists, $offset-1, $quantity);
        if(!empty($selected_files)){
            if ($selected_files[0] == '.')
                unset($selected_files[0]);

            if ($selected_files[1] == '..')
                unset($selected_files[1]);

            return $selected_files;
        }

    }

    public function view(Request $request)
    {

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $picture = $request->exists('dzFiles') ? $request->file('dzFiles') : false;

        if (! $picture instanceof UploadedFile )
            $picture = $request->exists('profile_pic') ? $request->file('profile_pic') : false;


        //return json_encode($request->file('dzFiles'));


        $url = 'images/' . date('Y') . '/' . date('m');
        $path = public_path( $url );

        if (! file_exists( $path ) )
            File::makeDirectory($path, 077, true, true);


        $filename = false;
        if ($picture instanceof UploadedFile){
            $mime = $picture->getMimeType();
            $name = $picture->getClientOriginalName();
            $filename = time().'-'.$name;
            $target = $picture->move($path, $filename );


            $is_image = explode('/', $mime);

            if ( $is_image[0] == 'image' ) {

                // Resizing Image
                $fn = pathinfo($filename, PATHINFO_FILENAME);
                $fileEXT = pathinfo($filename, PATHINFO_EXTENSION);

                $sizesArray = [
                    [
                        70, 70
                    ],
                    [
                        60, 60
                    ],
                    [
                        300, 200
                    ],
                    [
                        450, 450
                    ],
                    [
                        300, 360
                    ],
                    [
                        126, 126
                    ]
                ];

                foreach ($sizesArray as $size) {
                    $cropped_file_path = $path . '/' . $fn . '-' . $size[0] . 'x' . $size[1] . '.' . $fileEXT;
                    $img = Image::make($target)->resize($size[0], $size[1]);
                    $img->save($cropped_file_path);
                }

            }

            $post_status = PostStatus::where('status_title', 'published')->get(['id']);

            $post = new \Modules\Media\Entities\Post();
            $post->user_id = \Auth::user()->id;
            $post->content = $url . '/' . $filename;
            $post->post_type = 'attachment';
            $post->mime_type = $mime;
            $post->short_description = json_encode(['image-folder' => 'images/users']);
            $post->post_status_id = $post_status[0]->id;

            if ( $post->save() )
                return json_encode([ ['filename' => $post->content, 'id' => $post->id, 'mime_type' => $post->mime_type], 'status' => 'success']);

        }


        return  json_encode(['status' => 'failed']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $fileID
     * @return \Illuminate\Http\Response
     */
    public function destroy($fileID)
    {

        $file = \Modules\Media\Entities\Post::find($fileID);



        $path = public_path('/') . $file->content;
        $path = str_replace('\\', '/', $path);

        // Delete from DB
        //$post = Post::find($fileArr->id);
        \Modules\Media\Entities\Post::destroy( $fileID );


        // Delete from Directory
        if(File::delete( $path )){
            return 'deleted';
        }


        return 'failed';
    }

    public function bulk_delete(Request $request)
    {

        //return json_encode($request->all());

        $files = json_decode($request->input('files'));

        //$dir = $request->exists('dir') ? $request->input('dir') : 'images/posts/';



        $i=0;

        if(!empty($files)){
            foreach ($files as $fileArr) {

                $path = public_path('/') . $fileArr->file_name;
                $path = str_replace('\\', '/', $path);

                // Delete from DB
                //$post = Post::find($fileArr->id);
                \Modules\Media\Entities\Post::destroy($fileArr->id);


                // Delete from Directory
                if(File::delete( $path )){
                    $i++;

                }
            }
            if ($i > 0) echo 'deleted';
        }
    }



}

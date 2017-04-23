<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\CommonBackend\Http\Filters;
use Modules\Users\Entities\UserModel;
use Modules\Users\Filters\Table\UsersFilters;

class UsersController extends Controller
{
    use ValidatesRequests;

    public $max_file_size;


    public function __construct ()
    {
        $maxFileSize = ini_get('upload_max_filesize');
        $maxFileSize = str_replace('M', '', $maxFileSize);

        $this->max_file_size = $maxFileSize;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Filters $filters
     * @return Response
     */
    public function index(Request $request, Filters $filters)
    {
        $filters->column = ['id', 'full_name','cnic','email','picture', 'contact_number', 'user_role'];
        $limit = ($request->has('limit')) ? $request->input('limit') : 10;
        $users = UserModel::Filter($filters)
            ->paginate($limit);

        $perPage = $users->perPage();
        return view('users::index', compact('users','perPage'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $userroles = ['admin', 'staff', 'auctioneer', 'bidder'];
        $statuses = ['open', 'closed'];
        $maxFileSize = $this->max_file_size;

        return view('users::add-user', compact('userroles', 'statuses', 'user_saved', 'maxFileSize'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $validationArr = [
            'username'         => 'required|max:60|min:3|unique:users,username',
            'fullname'        	=> 'required|max:255|min:2',
            'email'            => 'required|max:255|email|unique:users,email',
            'status'           => 'required',
            'cnic'             => 'required|max:15',
            'picture'          => 'max:255',
            'contact_number'   => 'required|max:255',
            'user_role'        => 'required',
            'password'         => 'required|max:60|same:confirm_password',
            'confirm_password' => 'required|max:60|same:password',
            'url'              => 'max:255'

        ];

        // validating input form
        $this->validate($request, $validationArr);

        $user = new UserModel();

        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->cnic = $request->cnic;
        $user->contact_number = $request->contact_number;
        $user->picture = $request->picture;
        $user->password = Hash::make($request->password);
        $user->url = $request->url;
        $user->user_role = $request->user_role;
        $user->status = $request->status;
        $user->remember_token = '';

        $is_saved = $user->save();


        $user_saved = $is_saved ? true : false;

        $userroles = ['admin', 'staff', 'auctioneer', 'bidder'];
        $statuses = ['open', 'closed'];

        return back()->with( compact('user_saved', 'userroles', 'statuses'));
        return view('users::add-user', compact('user_saved', 'userroles', 'statuses'))->with('maxFileSize', $this->max_file_size);

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $user = UserModel::where('id', $id)->get();

        $userroles = ['admin', 'staff', 'auctioneer', 'bidder'];
        $statuses = ['open', 'closed'];

        if (isset($user[0]))
            $user = $user[0];

        $featured_img = $user->picture;
        return view('users::edit', compact('user', 'userroles', 'statuses', 'featured_img'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $validationArr = [
            'username'         => 'required|max:60|min:3|unique:users,username,' . $id,
            'full_name'        => 'required|max:255|min:2',
            'email'            => 'required|max:255|email|unique:users,email,' . $id,
            'status'           => 'required',
            'cnic'             => 'required|max:15',
            'picture'          => 'max:255',
            'contact_number'   => 'required|max:255',
            'user_role'        => 'required',
            'password'         => 'max:60|same:confirm_password',
            'confirm_password' => 'max:60|same:password',
            'url'              => 'max:255'

        ];


        // validating input form
        $this->validate($request, $validationArr);



        $data = $request->all();


        $data['updated_by'] = \Auth::id();


        $data['picture']    = $request->input('picture');


        $user = UserModel::find($id);

        $user->username = strtolower($data['username']);
        $user->status = strtolower($data['status']);
        $user->full_name = $data['full_name'];
        $user->cnic = $data['cnic'];
        $user->email = strtolower($data['email']);
        $user->url = strtolower($data['url']);
        $user->picture = $data['picture'];
        $user->contact_number = $data['contact_number'];
        $user->updated_by = $data['updated_by'];

        if (!empty($data['password']))
            $user->password = bcrypt($data['password']);

        $user->user_role = $data['user_role'];


        $isUpdated = $user->update();

        $isUpdated = $isUpdated ? 'update' : '';



        return back()->with('isUpdated', $isUpdated);
        //return view('admin.users.edit-user', compact('isUpdated', 'userroles', 'user'));

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $is_success = UserModel::destroy($id);

        return $is_success ? 'true' : 'not deleted';
    }
}

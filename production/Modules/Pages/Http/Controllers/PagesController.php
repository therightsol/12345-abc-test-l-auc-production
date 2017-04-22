<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\Post;
use Modules\Media\Entities\PostStatus;

class PagesController extends Controller
{
    public function help()
    {
        $page = Post::where('slug' , 'help-page')->with('post_status')->first();
        $postStatuses = PostStatus::pluck('status_title', 'id');
        return view('pages::help', compact('page', 'postStatuses'));
    }

    public function storeHelpPage(Request $request)
    {
        $page = Post::where('slug', 'help-page')->first();
        if($page){
            $isSuccess = $page->update(
                $request->only('title', 'post_status_id', 'content')
            );
        }else{
            $isSuccess = Post::create(
                array_merge($request->only('title', 'post_status_id', 'content'),['slug' => 'help-page'])
            );
        }

        return ($isSuccess) ?
            back()->with('alert-success', 'Page Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    public function rules()
    {
        $page = Post::where('slug' , 'rules-page')->with('post_status')->first();
        $postStatuses = PostStatus::pluck('status_title', 'id');
        return view('pages::rules', compact('page', 'postStatuses'));
    }

    public function storeRulesPage(Request $request)
    {
        $page = Post::where('slug', 'rules-page')->first();
        if($page){
            $isSuccess = $page->update(
                $request->only('title', 'post_status_id', 'content')
            );
        }else{
            $isSuccess = Post::create(
                array_merge($request->only('title', 'post_status_id', 'content'),['slug' => 'rules-page'])
            );
        }

        return ($isSuccess) ?
            back()->with('alert-success', 'Page Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }
}

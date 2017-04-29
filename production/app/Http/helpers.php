<?php
	/**
	 * Created by PhpStorm.
	 * User: Ali Shan
	 * Date: 15/04/2017
	 * Time: 12:07 PM
	 */
	
	
	function is_page_active( $slug = 'help-page' ){
		$page = \Modules\Media\Entities\Post::whereSlug( $slug )->whereHas('post_status', function($query){
			$query->where('status_title', 'published');
		})->get();
		
		if(isset($page[0]))
			return true;
		
		
		return false;
	}
	
	
	function show_login(){
		return (! \Auth::check());
	}
	
	function show_logout(){
		return (\Auth::check());
	}
	
	function get_usercolumn( $column = false ){
		if ($column)
			return strtoupper(Auth::getUser()->$column);
		
		return '';
	}
	
	function get_user_img(){
		$user = Auth::getUser();
		
		// if image not found
		if (empty($user->picture))
			return ( url('/' ) . '/images/image-not-found-100x100.png' );
		
		
		//if image found.
		return ( url('/' ) . '/' . $user->picture );
	}
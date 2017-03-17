<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect, Input, Auth;

use App\User, App\Post;

class SearchController extends Controller
{
	public function sort($sort){
		 $current= "NULL";


		if(strcmp($sort,"recent")==0)
    	{
    		
			$posts = Post::orderBy('created_at','desc')->get();

    		return view('homePage')
    				->with('posts', $posts)
    				->with('sort', $sort);

    	}
    	else if(strcmp($sort,"trending")==0)
    	{
			$posts = Post::get();

    		return view('homePage')
    			    ->with('posts', $posts)
    				->with('sort', $sort);
    	}
    	else if(strcmp($sort,"upvoted")==0)
    	{
			$posts = Post::orderBy('upvote','count')->get();

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);
    	}



	}
	
	public function search(){

    	$keyword = request('keyword');
    	$arr = explode('$',$keyword);
    	
    	
    	$sort = $arr[0];
     if($arr[1][0] == '#'){
     	return $arr[0]."TAG";
    		$keyword = strtolower(substr($arr[1], 1));
			//return $arr[0].$keyword;
    		//$posts = Post::where('tags', 'all', [$keyword])->get();
		if(strcmp($arr[0],"recent")==0)
    	{
    		
			$posts = Post::where('tags', 'all', [$keyword])->orderBy('created_at','desc')->get();

    		return view('homePage')
    				->with('posts', $posts)
    				->with('sort', $sort);

    	}
    	else if(strcmp($arr[0],"trending")==0)
    	{
			$posts = Post::get();

    		return view('homePage')
    			    ->with('posts', $posts)
    				->with('sort', $sort);
    	}
    	else if(strcmp($arr[0],"upvoted")==0)
    	{
			$posts = Post::where('tags', 'all', [$keyword])->orderBy('upvote','count')->get();

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);
    	}



    		$posts = Post::where('tags', 'all', [$keyword])->get();

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);

    	}else{


    		$keyword = strtolower($arr[1]);
    	  // 	return $arr[0].$keyword;
    		$posts = Post::where('location','LIKE','%'.$keyword.'%')->get();
    			if(strcmp($arr[0],"recent")==0)
    	{
    		
			$posts = Post::where('location','LIKE','%'.$keyword.'%')->orderBy('created_at','desc')->get();

    		return view('homePage')
    				->with('posts', $posts)
    				->with('sort', $sort);

    	}
    	else if(strcmp($arr[0],"trending")==0)
    	{
			$posts = Post::get();

    		return view('homePage')
    			    ->with('posts', $posts)
    				->with('sort', $sort);
    	}
    	else if(strcmp($arr[0],"upvoted")==0)
    	{
			$posts = Post::where('location','LIKE','%'.$keyword.'%')->orderBy('upvote','count')->get();

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);
    	}


    		$posts = Post::where('location','LIKE','%'.$keyword.'%')->get();

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);		
    	}
    }

}

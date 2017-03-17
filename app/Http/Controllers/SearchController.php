<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect, Input, Auth;

use App\User, App\Post;

class SearchController extends Controller
{
	
	public function search(){
    	$keyword = request('keyword');
    	
    	if($keyword[0] == '#'){
    		$keyword = strtolower(substr($keyword, 1));

    		$posts = Post::where('tags', 'all', [$keyword])->get();

    		return view('homePage')
    				->with('posts', $posts);

    	}else{
    		$posts = Post::where('location','LIKE','%'.$keyword.'%')->get();

    		return view('homePage')
    				->with('posts', $posts);		
    	}
    }

}

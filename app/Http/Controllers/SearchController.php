<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect, Input, Auth;

use App\User, App\Post;

class SearchController extends Controller
{
 	 public function searchLocation($tag){
    	$posts = Post::get()->where('location',$tag) ;

    	return view('homePage')
    			->with('posts', $posts);
    }
     public function searchtag($tag){
    	//$posts = Post::whereRaw(  'tag.text',"sushi"  )->get() ;

    	return view('homePage')
    			->with('posts', $posts);
    }

}

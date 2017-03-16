<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User, App\Post;

class PostsController extends Controller
{
    public function index(){
    	$posts = Post::all();

    	return view('homePage')
    			->with('posts', $posts);
    }

    public function create(){
    	return view('posts.create');
    }

    public function view($id){

    	$post = Post::findOrFail($id);



    	return view('posts.details')->with('post',$post);
    }


}

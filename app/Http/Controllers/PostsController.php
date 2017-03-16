<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User, App\Post;

class PostsController extends Controller
{
    public function index(){
    	$posts = Post::all();

    	return view('homePage');
    }
}

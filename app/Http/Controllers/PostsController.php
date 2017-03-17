<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect, Input, Auth;

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

    public function store(Request $request){
        $rules = [
            'tags'      =>  'required',
            'location'  =>  'required',
            'description'=> 'required',
            'video_url'  => 'url',
            'image'     =>  'image'
        ];

        $data = $request->all();
        
        $validation = Validator::make($data, $rules);
        
        if ($validation->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        } else {

            //return $data;
            $post = new Post();

            if( $request->hasFile('image') ) {
                $file = $request->file('image');
                // Now you have your file in a variable that you can do things with
                $name = str_random(30).'jpg';
                $destination = '/images/';
                $file->move(public_path().$destination, $name);

                $post->photo_url = $destination.$name;
            }

            $post->username = Auth::user()->name;
            $post->user_id = Auth::user()->_id;
            $post->description = $data['description'];
            $post->video_url = $data['video_url'];
            $post->location = $data['location'];
            $post->tags = explode(',',$data['tags']);

            if($post->save()){
                return redirect()->route('timeline')
                    ->with('success', 'posted successfully');
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'failed to post!');
            }
        } 
    }

    public function view($id){

    	$post = Post::findOrFail($id);

    	return view('posts.details')->with('post',$post);
    }




}

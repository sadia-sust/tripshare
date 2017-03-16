<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User, App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect, Input, Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::get();

        return view('home')
            ->with('posts', $posts);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $rules = [
            'post'   => 'required'
        ];

        $data = $request->all();

        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        } else {
            $post = new Post();
            $post->username = Auth::user()->name;
            $post->user_id = Auth::user()->_id;
            $post->post = $data['post'];

            if($post->save()){
                return redirect()->route('home')
                    ->with('success', 'posted successfully');
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'failed to post!');
            }
        } 
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view('posts.edit')
                ->with('post', $post);    
    }

    public function update(Request $request, $id){
        $rules = [
            'post'   => 'required'
        ];

        $data = $request->all();

        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        } else {
            $post = Post::findOrFail($id);
            $post->post = $data['post'];

            if($post->save()){
                return redirect()->route('home')
                    ->with('success', 'posted updated successfully');
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'failed to update post!');
            }
        }
    }

    public function delete($id){
        $post = Post::findOrFail($id);
        
        if($post->delete()){
            return redirect()->route('home')
                ->with('error', 'posted deleted successfully');
        }else{
            return redirect()->back()
                ->withInput()
                ->with('error', 'failed to delete post!');
        }
    }
}

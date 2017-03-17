<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect, Input, Auth;

use App\User, App\Post;

class PostsController extends Controller
{

    public function profile($id){
        $posts = Post::where('user_id',$id)->get();
        $sort= "NULL";

        return view('profile')
                ->with('posts', $posts)
                ->with('sort', $sort);
    }


    public function index(){
    	$posts = Post::all();
        $sort= "NULL";

    	return view('homePage')
    			->with('posts', $posts)
                ->with('sort', $sort);
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
            $post->tags = array_map('strtolower',explode(',',$data['tags']));

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

    public function comment(Request $request, $id){
		$rules = [
            'comment'	=>  'required'
        ];

        $data = $request->all();
        
        $validation = Validator::make($data, $rules);
        
        if ($validation->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        } else {
			$post = Post::findOrFail($id);
			$comment = [
				'comment'	=>	$data['comment'],
				'user'		=>	[
									'_id' => Auth::user()->_id,
									'name'=> Auth::user()->name
								],
				'created_at' =>	(new \DateTime())
				];

			if($post->push('comments', $comment)){
				return redirect()->back()
                    ->with('success', 'commented successfully');
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'failed to comment!');
            }
		}
    }

    public function upvote($id){

        $post = Post::findOrFail($id);

        $upvote = Auth::user()->_id;

        $flag = '1';

        for($i = 0; $i < count($post->downvotes); $i++){
        if($post->downvotes[$i]==$upvote)
            {
                $flag = '0';
                $downvote = $post->downvotes[$i];
            }
            
        }

        if($flag=='1'){

            if($post->push('upvotes', $upvote,true))
                {
                    return redirect()->back()
                            ->with('success', 'upvoted successfully');
                }
            else
                {
                    $post->pull('upvotes', $upvote);
                    return redirect()->back()
                            ->with('success', 'upvoted successfully');
                }
            }
        else
        {
            $post->pull('downvotes', $downvote);

            if($post->push('upvotes', $upvote,true))
                {
                    return redirect()->back()
                            ->with('success', 'upvoted successfully');
                }
            else
                {
                    $post->pull('upvotes', $upvote);
                    return redirect()->back()
                            ->with('success', 'upvoted successfully');
                }


        }



        // if($post->push('upvotes', $upvote,true))
        // {
        //     return redirect()->back()
        //             ->with('success', 'upvoted successfully');
        // }
        // else
        // {
        //     $post->pull('upvotes', $upvote);
        //     return redirect()->back()
        //             ->with('success', 'upvoted successfully');
        // }

       // if($post->push('upvotes', $upvote,true)){
       //          return redirect()->back()
       //              ->with('success', 'upvoted successfully');
       //      }else{
       //          return redirect()->back()
       //              ->withInput()
       //              ->with('error', 'failed to upvote!');
       //      }


    }

    public function downvote($id){

        $post = Post::findOrFail($id);

        $downvote = Auth::user()->_id;
        $flag = '1';

        for($i = 0; $i < count($post->upvotes); $i++){
        if($post->upvotes[$i]==$downvote)
            {
                $flag = '0';
                $upvote = $post->upvotes[$i];
            }
            
        }

        if($flag=='1'){

            if($post->push('downvotes', $downvote,true))
                {
                    return redirect()->back()
                            ->with('success', 'downvoted successfully');
                }
            else
                {
                    $post->pull('downvotes', $downvote);
                    return redirect()->back()
                            ->with('success', 'downvoted successfully');
                }
            }
        else
        {
            $post->pull('upvotes', $upvote);

            if($post->push('downvotes', $downvote,true))
                {
                    return redirect()->back()
                            ->with('success', 'downvoted successfully');
                }
            else
                {
                    $post->pull('downvotes', $downvote);
                    return redirect()->back()
                            ->with('success', 'downvoted successfully');
                }


        }
        


        
    }




}

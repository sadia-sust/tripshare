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
    		
			$posts = Post::orderBy('created_at','desc')->paginate(10);

    		return view('homePage')
    				->with('posts', $posts)
    				->with('sort', $sort);

    	}
    	else if(strcmp($sort,"trending")==0)
    	{
			$posts = Post::paginate(10);

    		return view('homePage')
    			    ->with('posts', $posts)
    				->with('sort', $sort);
    	}
    	else if(strcmp($sort,"upvoted")==0)
    	{

			$posts = Post::orderBy('upvote','count')->paginate(10);
			//return sizeof($posts[0]->upvotes);
			$temp2 = [];

			for($i =0;$i< count($posts); $i++)
			{

				$temp2[] =  $posts[$i];

				
			}
			for($i=0;$i<count($temp2);$i++)
			for($j=0;$j<=count($temp2);$j++)
			{
				if(count($temp2[$i]->upvotes) <count($temp2[$j]->upvotes)    )
				{
					$tm =  $temp2[$i]->upvotes;
					$temp2[$i]->upvotes = $temp2[$j]->upvotes;
					$temp2[$j]->upvotes = $tmp;

				}

			}
			return $temp2;

			$posts = Post::orderBy('upvote','count')->paginate(10);


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
    		$keyword = strtolower(substr($arr[1], 1));
			//return $arr[0].$keyword;
    		//$posts = Post::where('tags', 'all', [$keyword])->get();
		if(strcmp($arr[0],"recent")==0)
    	{
    		
			$posts = Post::where('tags', 'all', [$keyword])->orderBy('created_at','desc')->paginate(10);

    		return view('homePage')
    				->with('posts', $posts)
    				->with('sort', $sort);

    	}
    	else if(strcmp($arr[0],"trending")==0)
    	{
			$posts = Post::paginate(10);

    		return view('homePage')
    			    ->with('posts', $posts)
    				->with('sort', $sort);
    	}
    	else if(strcmp($arr[0],"upvoted")==0)
    	{

			$posts = Post::where('tags', 'all', [$keyword])->orderBy(\DB::raw('count(upvotes)', 'DESC'))->get();

			$posts = Post::where('tags', 'all', [$keyword])->orderBy('upvote','count')->paginate(10);


    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);
    	}



    		$posts = Post::where('tags', 'all', [$keyword])->paginate(10);

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);

    	}else{


    		$keyword = strtolower($arr[1]);
    	  // 	return $arr[0].$keyword;
    		$posts = Post::where('location','LIKE','%'.$keyword.'%')->paginate(10);
    			if(strcmp($arr[0],"recent")==0)
    	{
    		
			$posts = Post::where('location','LIKE','%'.$keyword.'%')->orderBy('created_at','desc')->paginate(10);

    		return view('homePage')
    				->with('posts', $posts)
    				->with('sort', $sort);

    	}
    	else if(strcmp($arr[0],"trending")==0)
    	{
			$posts = Post::paginate(10);

    		return view('homePage')
    			    ->with('posts', $posts)
    				->with('sort', $sort);
    	}
    	else if(strcmp($arr[0],"upvoted")==0)
    	{

			$posts = Post::get();
			return $posts;

			$posts = Post::where('location','LIKE','%'.$keyword.'%')->orderBy('upvote','count')->paginate(10);

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);
    	}


    		$posts = Post::where('location','LIKE','%'.$keyword.'%')->paginate(10);

    		return view('homePage')
        				->with('posts', $posts)
    				->with('sort', $sort);		
    	}
    }

}

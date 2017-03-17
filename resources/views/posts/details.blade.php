@extends('layouts.layout')
@section('content')
      	  
<div class="clear"> </div>

<div class="content">
	<div class="wrap">
	<div class="single-page">
	<div class="single-page-artical">
		<div class="artical-content">
		@if($post->photo_url)
            {!! Html::image($post->photo_url, 'a picture', array('class' => 'thumb')) !!}
         @endif
        @if($post->video_url)
            @if(\Embed::make($post->video_url)->parseUrl())
                {!! \Embed::make($post->video_url)->parseUrl()->setAttribute(['width' => '100%', 'height' => '500px'])->getHtml() !!}
            @endif
        @endif

        <hr>
        	@if(Auth::user())
			@if($post->user_id == \Auth::user()->_id) 
			<div class="row pull-right">
				<span>
					<a class="btn btn-warning" href="{!! route('post.edit',$post->_id) !!}">Edit</a>
					<a class="btn btn-danger" data-toggle="confirmation" data-title="Delete Post?" href="{!! route('post.delete', $post->_id) !!}">Delete</a>

					<a class="btn btn-large btn-primary" data-toggle="confirmation" data-title="Open Google?"
   href="https://google.com" target="_blank">Confirmation</a>
   
				</span>
			</div>
			@endif
			@endif
			<h3><a href="#">{!! $post->location !!}</a></h3>
			<h4 class="pull-right"><a href="{!! route('profile',$post->user_id) !!}"><i class="fa fa-user"></i>{!! $post->username !!}'s timeline</a></h4>

			@for($i = 0; $i < count($post->tags); $i++)
                <span><a href="#"> #{!! $post->tags[$i] !!} </a></span>
            @endfor

			<p>{!! $post->description !!}</p> 
		    </div>
		    
			 <div class="share-artical pull-left">
			 	<ul>
			 		<!-- <li><a href="#"><i class="fa fa-thumbs-o-up"></i> </a>{!! count($post->upvotes) !!}</li> -->
			 		<li><a href="{!! route('post.upvote',$post->_id) !!}"><i class="fa fa-thumbs-o-up"></i> {!! count($post->upvotes) !!}</a></li>

			 		<li><a href="{!! route('post.downvote',$post->_id) !!}"><i class="fa fa-thumbs-o-down"></i> {!! count($post->downvotes) !!}</a></li>
			 		<li><i class="fa fa-comments-o"></i> {!! count($post->comments) !!}</li>
			 	</ul>
			 </div>
			
			<!--  <div class="share-artical pull-right">
			 	<ul>
			 		<li><a href="#"><img src="{!! asset('images/facebooks.png') !!}" title="facebook">Facebook</a></li>
			 		<li><a href="#"><img src="{!! asset('images/twiter.png') !!}" title="facebook">Twitter</a></li>
			 		<li><a href="#"><img src="{!! asset('images/google-plus.png') !!}" title="facebook">Google+</a></li>
			 	</ul>
			 </div> -->

			 <div class="clear"> </div>
	</div>
					
	<div class="comment-section">
		<div class="grids_of_2">
			@if(count($post->comments)>0)
			<h3>Comments</h3>
			@endif

			@for($i = 0; $i < count($post->comments); $i++)
			<div class="grid1_of_2">
				
				<div class="grid_text">
					

					<h4><a href="#">{!! $post->comments[$i]['user']['name'] !!}</a></h5>
					<h6>{!! \Carbon\Carbon::parse($post->comments[$i]['created_at']['date'])->format('d-m-Y') !!}</h6>
					<p class="para top"> {!! $post->comments[$i]['comment'] !!}</p>

				</div>
				<div class="clear"></div>
			</div>
			@endfor
				<div class="artical-commentbox">
				 	<h3>Leave a Comment</h3>
		  			<div class="table-form">

		  				{!! Form::open([
                        	'route' => ['post.comment',$post->_id],
                        	'method' => 'post'
	                      ]) 
	                    !!}

							<div>
								<label>Your Comment<span>*</span></label>
								<textarea name="comment"> </textarea>	
							</div>

							<input type="submit" value="submit">

						{!! Form::close() !!}	
					</div>
					<div class="clear"> </div>
		  		</div>			
			</div>
	</div>
					
	</div>
	</div>
</div>
							
@endsection


@section('script')
{!! Html::script('js/bootstrap-confirmation.js') !!}

<script type="text/javascript">
	$('[data-toggle=confirmation]').confirmation({
	  rootSelector: '[data-toggle=confirmation]',
	  // other options
	});
</script>

@end
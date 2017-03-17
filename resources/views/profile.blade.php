@extends('layouts.layout')

@section('content')
    <div class="row">
        {!! Form::open([
            'route' => 'search',
            'method' => 'get'
            ]) 
        !!}
        <div class="col-md-2 col-md-offset-1">
        <div class="dropdown">
          <button class="dropbtn">View By</button>
          <div class="dropdown-content">
            <a href="{!! route('sort','recent') !!}">Recent Updates</a>
            <a href="{!! route('sort','trending') !!}">Trending</a>
            <a href="{!! route('sort','upvoted') !!}">Most upvoted</a>
          </div>
        </div>
        </div>
        <div class="input-group col-md-7">
          <input name="keyword" type="text" class="form-control" required>
          <div class="input-group-btn">
            <!-- Buttons -->
            <button class="btn btn-info" type="submit">Search</a>
          </div>
        {!! Form::close() !!}
          <div class="pull-right">
            <a class="btn btn-success" href="{!! route('post.create') !!}"><i class="fa fa-plus"></i></a>
        </div>
        </div>    
    </div>
    <br>
    <ul id="tiles">
        <!-- These are our grid blocks -->
        @foreach($posts as $post)
            <li><a href="{!! route('post.details',$post->_id) !!}">
                @if($post->photo_url)
                    {!! Html::image($post->photo_url, 'a picture', array('class' => 'thumb')) !!}
                @elseif($post->video_url)
                    @if(\Embed::make($post->video_url)->parseUrl())
                        {!! \Embed::make($post->video_url)->parseUrl()->setAttribute(['width' => '100%', 'height' => '100%'])->getHtml() !!}
                    @endif
                @endif
                </a>
                <div class="post-info">
                    <div class="post-basic-info">
                        <h3><a href="{!! url('search/?keyword='.$sort. '$' .$post->location) !!}"><label> </label>{!! $post->location !!} </a></h3>
                        
                        @for($i = 0; $i < count($post->tags); $i++)
                            <span><a href="{!! url('search?keyword='.$sort. '$%23' .$post->tags[$i]) !!}"> #{!! $post->tags[$i] !!} </a></span>
                        @endfor
                        <a href="{!! route('post.details',$post->_id) !!}">
                        <p>{!! str_limit($post->description, 100) !!}</p>
                        </a>
                    </div>
                    <div class="post-info-rate-share">
                        <div class="row">
                            <span class="col-md-offset-1">
                                <i class="fa fa-thumbs-o-up"></i> {!! count($post->upvotes) !!}
                                <i class="fa fa-thumbs-o-down"></i> {!! count($post->downvotes) !!}
                            </span>
                            <span class="col-md-offset-4">
                                <a href="{!! route('post.details',$post->_id) !!}">
                                    Read More
                                </a>
                            </span>
                        </div>
                        <div class="clear"> </div>
                    </div>
                </div>
            </li>
        @endforeach
        <!-- <li onclick="location.href='single-page.html';">
            <img src="images/img1.jpg" width="282" height="118">
            <div class="post-info">
                <div class="post-basic-info">
                    <h3><a href="#">Animation films </a></h3>
                    <span><a href="#"><label> </label>Movies</a></span>
                    <p>Lorem Ipsum is simply dummy text of the printing & typesetting industry.</p>
                </div>
                <div class="post-info-rate-share">
                    <div class="rateit">
                        <span> </span>
                    </div>
                    <div class="post-share">
                        <span> </span>
                    </div>
                    <div class="clear"> </div>
                </div>
            </div>
        </li> -->
        <!-- End of grid blocks -->
    </ul>
@endsection
@section('style')
{!! Html::style('/css/dropdown.css') !!}
@stop
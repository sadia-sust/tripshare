@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="input-group col-md-7 col-md-offset-3">
          <input type="text" class="form-control" aria-label="...">
          <div class="input-group-btn">
            <!-- Buttons -->
            <button class="btn btn-info" type="submit">Search</a>
          </div>
          <div class="pull-right">
            <a class="btn btn-success" href="{!! route('post.create') !!}"><i class="fa fa-plus"></i></a>
        </div>
        </div>    
    </div>
    <br>
    <ul id="tiles">
        <!-- These are our grid blocks -->
        @foreach($posts as $post)
            <li onclick="location.href='single-page.html';">
                @if($post->image_url)
                    <img src="{!! $post->image_url !!}" width="282" height="118">
                @elseif($post->video_url)

                    {!! \Embed::make($post->video_url)->parseUrl()->setAttribute(['width' => '100%', 'height' => '100%'])->getHtml() !!}

                @endif
                <div class="post-info">
                    <div class="post-basic-info">
                        <h3><a href="#"><label> </label>{!! $post->location['name'] !!} </a></h3>
                        
                        @for($i = 0; $i < count($post->tags); $i++)
                            <span><a href="#"> #{!! $post->tags[$i] !!} </a></span>
                        @endfor

                        <p>{!! str_limit($post->description, 100) !!}</p>
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

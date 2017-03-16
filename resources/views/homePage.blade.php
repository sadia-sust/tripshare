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
        <li onclick="location.href='single-page.html';">
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
        </li>
        <!-- End of grid blocks -->
    </ul>
@endsection

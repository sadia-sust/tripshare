@extends('layouts.layout')

@section('content')
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

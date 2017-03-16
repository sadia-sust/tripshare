@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new post</div>
                    <form action="" method="post" enctype="multipart/form-data" name="personal_image" id="newHotnessForm">
    <p><label for="image">Upload Image:</label>
    <input type="file" id="imageUpload"/></p>
    <p><button type="submit" class="button">Upload</button></p>
        <div id="preview">
            <img width="160px" height="120px" src="profile pic.jpg" id="thumb" />
        </div>
    </form>
                <div class="panel-body">
                    @include('layouts.alert')
                    {!! Form::open([
                        'route' => 'store',
                        'method' => 'post'
                      ]) 
                    !!}

                    {!! Form::textarea('post', null, [
                        'class' => 'form-control', 
                        'placeholder' => 'Write a post', 
                        'required']
                        )
                    !!}

                      <div class="contact-form">
                        <div class="contact-to">
                            <input type="text" class="text" value="Name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name...';}">
                            <input type="text" class="text" value="Email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}">
                            <input type="text" class="text" value="Subject..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject...';}">
                        </div>
                        <div class="text2">
                           <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message..</textarea>
                        </div>
                       <span><input type="submit" class="" value="Submit"></span>
                        <div class="clear"></div>
                       </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

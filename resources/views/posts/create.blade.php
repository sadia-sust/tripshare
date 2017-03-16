@extends('layouts.layout')

@section('content')
<div class="container">

     <div class="col-md-8 col-md-offset-2">
                 
                </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new post</div>
                
                <div class="panel-body">
                    @include('layouts.alert')
                    {!! Form::open([
                        'route' => 'store',
                        'method' => 'post'
                      ]) 
                    !!}

                    <div class="form-group">
                       <div class="" id="image-preview" >
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" name="image" id="image-upload" />
                        </div>                  
                    </div>
                    <div class="form-group">
                        {!! Form::url('video_url', null, ['pattern'="https?://.+",'class'=>'form-control', 'placeholder'=>'Enter youtube video link']) !!}
                     </div>
                    <div class="form-group">
                      {!! Form::text('location', null, ['id'=>'address', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <input type="text" id="input-tags" class="demo-default" placeholder="Tags">
                     </div>
                     

                    <div class="form-group">
                    {!! Form::textarea('post', null, [
                        'class' => 'form-control', 
                        'placeholder' => 'Write a post', 
                        'required']
                        )
                    !!}
                    </div>

                    {!! Form::submit('Submit', ['class'=>'form-control btn btn-info']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')

{!! Html::style('/css/uploadfile.css') !!}

{!! Html::style('/css/location_style.css') !!}

{!! Html::style('/css/selectizenormalize.css') !!}

{!! Html::style('/css/selectizestylesheet.css') !!}



@stop

@section('script')
{!! Html::script('http://code.jquery.com/jquery-2.0.3.min.js') !!}

{!! Html::script('/js/jquery.uploadPreview.min.js') !!}

{!! Html::script('http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places') !!}
{!! Html::script('/js/jquery.uploadPreview.min.js') !!}
{!! Html::script('/js/jquery.geocomplete.min.js') !!}
{!! Html::script('/js/selectize.js') !!}
{!! Html::script('/js/index.js') !!}



<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });
});
</script>
<script type="text/javascript">
    $('#input-tags').selectize({
        persist: false,
        createOnBlur: true,
        create: true
    });
    </script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU"></script>
        <script>
            var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                alert(document.getElementById('address').value);
            });
        </script>

@stop

@extends('layouts.layout')

@section('content')
<div class="container">
     <div class="col-md-8 col-md-offset-2">
                 
                </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new post</div>
               <div>
                   <div id="image-preview">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="image" id="image-upload" />
                    </div>                  
                 </div>
                
                <div class="panel-body">
                    @include('layouts.alert')
                    {!! Form::open([
                        'route' => 'store',
                        'method' => 'post'
                      ]) 
                    !!}
                     <input type="text" id="address" style="width: 500px;"></input>

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

@section('style')

{!! Html::style('/css/uploadfile.css') !!}

{!! Html::style('/css/location_style.css') !!}


@stop

@section('script')
{!! Html::script('http://code.jquery.com/jquery-2.0.3.min.js') !!}

{!! Html::script('/js/jquery.uploadPreview.min.js') !!}

{!! Html::script('http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places') !!}
{!! Html::script('/js/jquery.uploadPreview.min.js') !!}
{!! Html::script('/js/jquery.geocomplete.min.js') !!}



       <script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });
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

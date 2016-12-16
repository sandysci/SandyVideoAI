@extends('layout.master')
@section('content')
    
    <div id="responsecontainer" style="color:black;font-family:cursive">
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong><center><p class ="mark">Solution for SCI AI Challenge</p></center></strong>
        	<p><strong>Name:</strong>Ezeibe Sandra Chioma</p>

                <ul>
                <strong><u>Steps Involve</u></strong>

                    <li>Upload Video</li>

                    <li>Enter time frame u want to generate</li>

                    <li>Play audio (optional)</li>
                </ul>
        </div>
        	       <br><br>
        @if(isset($errors))
            @foreach($errors->all() as $error)
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    	<p> {{ $error }}</p><br>
                </div>  
            @endforeach
        @endif

        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{!!Session::get('message') !!}</strong> 
            </div>
        @endif
           
    
    </div>
    
@stop
@section('content2')
    <div id="responsecontainer" style="color:black;font-family:cursive"> 
    	<form  id="form_id" method="post" action={{ url('storevideo')}} enctype= "multipart/form-data">
    		{{ csrf_field() }}
            <input type="file"  name ="video" accept="video/*" id="video" required/>
            <br>
    		<input type="submit" class="btn btn-primary" value ="Upload Video">   	
        </form>  	
        <ul class="portfolio">
                                
            {{-- <li class="span8" >
                <div class="item">
    	            <video id="v1"  width="300" height="300" controls autoplay>
    	            </video>
                </div>
            </li>    --}}                    
        </ul>
    </div>
@stop
@section('video')
    @if(isset($videos) && $videos->count() > 0)
        @foreach($videos as $video)
            <div class="row-fluid">
                     <div class="span12 content">
                        <div class="row-fluid">
                             <div class="span6">
                                <ul class="portfolio">
            				       <li class="span6">
            				           <div class="item">
            				               <video id="v1"  width="300" height="300" controls >
            				               	<source src="video/{!!$video->name !!}">
            				            </video>
            				           </div>
            				       </li>
            				     </ul>
            				                    
                             </div>
                             <div class="span6">
                                 <form method="post" action={{ url('storevideoframe')}} enctype= "multipart/form-data"><br><br>
                                     <fieldset>
                                     	{{ csrf_field() }}
                                        <div class="control-group">
                                            <div class="controls">
                                                <input class="span6" type="number" min="1" name="start_frameperiod" required placeholder="Start time">
                                            </div>
                                            <div class="controls">
                                                <input class="span6" type="number" name="end_frameperiod" required placeholder="End time">
                                            </div>          
                                                <input class="span6" type="hidden"value="{!!$video->id !!}" name="video_id" required >
                                                <input class="span6" type="hidden"value="{!!$video->name !!}" name="video_name" required >
                                                <button type="submit" class="btn btn-default">Generate Frame</button>
                                        </div>
                                     </fieldset>
                                 </form>

                                 {!!link_to_route('getframe','View Generated Frame',$video->id ,array('class'=>'btn btn-info btn-xs'))!!}
                             </div>
                        </div>
                 </div>
            </div>

        @endforeach
    @else
    {{ "No video uploaded yet" }}
    @endif	

@stop

{!! Html::script('js/jquery.min.js')!!}
<script type="text/javascript">

$(document).ready(function(){

    $('#update').hide();
    $("#video").on('change', function(event) {
            var file = event.target.files[0];
            if(file.size >= 8*1024*1024)
             {  
                bootbox.alert("maximum size accepted is 8MB, try another again");
                this.value='';
                return;
            }
            else if(!(file.type = "video/mp4") || !(file.type = "video/asf") || !(file.type = "video/msvideo") || 
                !(file.type = "video/mpeg") || !(file.type = "video/ogg") || !( file.type = "video/quicktime") || 
                !(file.type = "video/x-ms-wmv") ||  !(file.type = "video/x-msvideo") )
            {   
                bootbox.alert("Must be a video format");
                this.value='';
                return;
            }
        });

    setInterval(function(){cache_clear()},600000);
});

function cache_clear()
{
window.location.reload(true);
}
</script>
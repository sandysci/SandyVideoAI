@extends('layout.masterframe')
@section('frame')

@if(Session::has('message'))
    <p class="bg-warning"> {!!Session::get('message') !!}</p>
@endif

@if(isset($record) && $record->count() >0)
@foreach($record as $rec)
<div class="row-fluid">
	<center><h2 class="lead">Audio and Slide File for {!!$rec->video->name !!}</h2></center>
    <div class="span10 content">
        <div class="row-fluid">
        	<div class="span6">
                <ul class="portfolio">
        			<li class="span6">
        				   <div class="item">
        				   	<p class="lead">Audio File:</p>
        				        <audio width="300" height="300" id="player" src="{!! url('audio\\'.$rec->audio_name)!!}"
        				         controls type="audio/mpeg">
        				     	</audio>
        				     	<div style="text-align:center">
								    <button class="btn btn-primary"  onclick="document.getElementById('player').play()">Play</button>
								    <button class="btn btn-primary"  onclick="document.getElementById('player').pause()">Pause</button>
								</div>

        				   </div>
        			</li>
        		</ul>
        				                    
            </div>
            <div class="span6">
            	<p class="lead">Slide:</p>
				    <div  style ="width:320px; height:240px:"class="thumbnail_slider flexslider">
                            <ul class="slides">
                                    @foreach( $rec->videoframe as $r)
                                         <li><img src="{!! url('videoframes\\'.$r->name)!!}"></li>
                                    @endforeach 
                            </ul>           
                    </div>
            </div>
       	</div>
    </div>
</div>
<br>
@endforeach
@else
{!! "No frame geanerated yet" !!}
@endif
@stop

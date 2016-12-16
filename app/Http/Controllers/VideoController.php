<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use Validator;
use Session;
use App\Video;
use App\VideoFrame;
use App\Record;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $ffmpeg;

    public function __construct()
    {
        $this->ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe',
            'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
            ));
    }

    public function index()
    {
        $videos = Video::all();

        return view('pages.home')->withVideos($videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function storeVideo(Request $request)
    {
        $data = $request->except('_token');

        $validator = Validator::make($data, Video::$rules);

        if ($validator->fails()) 
              {
                // send back to the page with the input data and errors
                return redirect('/')->withInput()->withErrors($validator);
              }
        else
            {
                
                $file = $request->video;

                $file1 = $request->video;
                
                $filename = $file->getClientOriginalName();
                
                $fileonlyname = pathinfo($filename, PATHINFO_FILENAME);
                
                if ($request->video != null && $request->video->isValid()) 
                    {
                        $fullfilename = time().$fileonlyname.'.webm';
                    
                        $dbfilename = time().$filename;
                    
                        $video = $this->ffmpeg->open($file1);
                    
                        $video
                        ->filters()
                        ->resize(new \FFMpeg\Coordinate\Dimension(320, 240))
                        ->synchronize();
                       
                        $video
                        ->save(new \FFMpeg\Format\Video\WEBM(), 'video\\'.$fullfilename);
                    
                        $file->move(public_path('video/'),$dbfilename);
                    
                        $vid = new Video;
                    
                        $vid->name = $fullfilename;
                    
                        $vid->save();

                        return redirect('/')->withMessage('You have successfully uploaded this video click on all video to see it');
                    }
            }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVideoframe(Request $request)
    {   

        $data = $request->all();

        if($data['end_frameperiod'] > $data['start_frameperiod'])
            {
                $id = $data['video_id'];

                $clickedvideo = Video::find($id);

                $filename = $clickedvideo->name;

                $fileonlyname = pathinfo($filename, PATHINFO_FILENAME);
                //get the video
                $video = $this->ffmpeg->open('video\\'.$clickedvideo->name);

                $video
                    ->filters()
                    ->resize(new \FFMpeg\Coordinate\Dimension(320, 240))
                            ->synchronize();
                //get the video for the time frame
                $video->filters()
                    ->clip(\FFMpeg\Coordinate\TimeCode::fromSeconds($data['start_frameperiod']), 
                        \FFMpeg\Coordinate\TimeCode::fromSeconds($data['end_frameperiod']))
                    ->synchronize();
                $randaudio=str_random($length = 4);
                $video->save(new \FFMpeg\Format\Video\OGG(), 'video2\\'.$fileonlyname.$randaudio.'.ogg');

                $video2 = $this->ffmpeg->open('video2\\'.$fileonlyname.$randaudio.'.ogg');
                //generate audio
                $video2->save(new \FFMpeg\Format\Audio\MP3(), 'audio\\'.$fileonlyname.$randaudio.'.mp3');

                // $video->save(new \FFMpeg\Format\Audio\Mp3(), 'ola.mp3')

                $record = new Record;

                $record->video_id = $id;
                
                $record->audio_name =$fileonlyname.'.mp3';
                
                $record->save();

                    for($i=$data['start_frameperiod']; $i<=$data['end_frameperiod']; $i++)
                    {

                    $rand=str_random($length = 4);
                    $video
                    ->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds($i))
                    ->save('videoframes\\'.$fileonlyname.$i.$rand.'.jpg');
                    $videoframe = new VideoFrame;
                    $videoframe->name = $fileonlyname.$i.$rand.'.jpg';
                    $videoframe->record_id = $record->id;
                    $videoframe->save();
                }
                
                return redirect('/getframe/'.$id)->withMessage('You have successfully created frames');
            }
        else
        {
         return redirect('/')->withMessage('End time must be greater than start time');   
        }




        //
    }

     /**s
     * Show the frame.
     *
     * @param  int  $id =video_id
     *
     */
   
     public function getFrame($id)
    {
        $record=Record::where('video_id',$id)->get();

        return view('pages.frame')->withRecord($record);
    }

    /**s
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}

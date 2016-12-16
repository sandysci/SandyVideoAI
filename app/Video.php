<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Record;

class Video extends Model
{
    //
    protected $table = 'videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // mimes:video/x-flv,video/mp4,video/mp2t,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv
    protected $fillable = ['name'];

    public static $rules=array('video' =>'required');

    public function record()
    {
       return $this->hasOne('\App\Record','video_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Video;

use App\VideoFrame;

class Record extends Model
{
    //
    protected $table = 'records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['audio_name','video_id'];

    public function video()
    {
       return $this->belongsTo('\App\Video','video_id');
    }
    public function videoframe()
    {
       return $this->hasMany('\App\VideoFrame','record_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Video;

use App\Record;


class VideoFrame extends Model
{
    //
    protected $table = 'videoframe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','record_id'];

    public function record()
    {
       return $this->belongsTo('\App\Record','record_id');
    }
}

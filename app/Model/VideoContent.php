<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    protected $fillable = ['video_id', 'key', 'value'];
}

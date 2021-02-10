<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GobalPostMeta extends Model
{
    protected $fillable = [
        'gobal_post_id',
        'key',
        'value',
        'post_type',
    ];
}

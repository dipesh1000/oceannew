<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'coursable_id',
        'coursable_type',
        'rating',
        'review'
    ];
    public function courseItem()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }
    
}

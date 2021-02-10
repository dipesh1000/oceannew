<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SavedCourse extends Model
{
    protected $fillable = [
        'user_id',
        'saveable_id',
        'saveable_type'
    ];
    public function savedItem()
    {
        return $this->morphTo();
    }
}

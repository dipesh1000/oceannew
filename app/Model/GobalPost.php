<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class GobalPost extends Model
{
    use Sluggable, LogsActivity, SoftDeletes;

    protected static $logAttributes = ['title', 'post_type', 'post_content'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'Post';
    protected static $logOnlyDirty = true;


    protected $fillable = [
        'title',
        'slug',
        'post_author',
        'post_content',
        'position',
        'status',
        'post_parent',
        'post_type',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function postMetas(){
        return $this->hasMany(GobalPostMeta::class, 'gobal_post_id');
    }
    
    public function seoable()
    {
        return $this->morphOne(SeoContent::class, 'seoable');
    }
}

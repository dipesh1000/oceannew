<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CustomField extends Model
{
    use Sluggable, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['title', 'icon'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'CustomField';
    protected static $logOnlyDirty = true;


    protected $fillable = [
        'post_author',
        'post_content',
        'title',
        'slug',
        'status',
        'post_parent',
        'post_type',
        'field_position',
        'position',
        'field_type',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function childrens(){

        return $this->hasMany(CustomField::class, 'post_parent', 'id')->orderBy('position', 'ASC');

    }

    public function postType(){
        return $this->belongsTo(PostType::class, 'post_type', 'id');

    }
}

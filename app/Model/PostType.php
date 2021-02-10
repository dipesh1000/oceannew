<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class PostType extends Model
{
    use Sluggable, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['title', 'icon'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'PostType';
    protected static $logOnlyDirty = true;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'has_archive',
        'position',
        'status',
        'icon',
        'feature_image',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function customFields(){
        return $this->hasMany(CustomField::class, 'post_type')->where('status', 'Active')->orderBy('position', 'ASC');
    }

    public function posts(){
        return $this->hasMany(GobalPost::class, 'post_type');
    }

    public function hasManyRelationship($id){
        return "aaa";
    }
}

<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Video extends Model
{
    use Sluggable, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['title', 'video'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'Video';
    protected static $logOnlyDirty = true;


    protected $fillable = [
      'title',
      'category_id',
      'slug',
      'video',
      'feature',
      'preview',
      'position',
      'image',
      'author',
      'time',
      'description',
      'table-of-content',
      'status',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function videoContent(){
        return $this->hasMany(VideoContent::class, 'video_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function packageItem(){
        return $this->morphMany(PackageItem::class, 'itemable');
    }
    public function orderItem()
    {
        return $this->morphMany(Order::class, 'purchaseble');
    }
    public function savedItem()
    {
        return $this->morphMany(SavedCourse::class, 'saveable');
    }
    public function courseItem()
    {
        return $this->morphMany(Feedback::class, 'coursable');
    }
}

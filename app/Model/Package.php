<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model
{
    use Sluggable, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['title'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'Package';
    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'price',
        'image',
        'package_type',
        'valid_time',
        'valid_time_type',
        'description',
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

    public function packageItem(){
        return $this->hasMany(PackageItem::class, 'package_id');
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

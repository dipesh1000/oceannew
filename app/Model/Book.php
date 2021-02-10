<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Book extends Model
{
    use Sluggable, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['title', 'digital_or_hardcopy'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'Book';
    protected static $logOnlyDirty = true;
    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'book',
        'position',
        'image',
        'author',
        'isbn_no',
        'sku',
        'edition',
        'language',
        'description',
        'table_of_content',
        'status',
        'digital_or_hardcopy',
        'quantity',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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

<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use Sluggable, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['title', 'icon'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    protected static $logName = 'Category';
    protected static $logOnlyDirty = true;


    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'icon',
        'image',
        'status',
        'description',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function childs() {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function getAllChildren ()
    {
        $sections = new Collection();

        foreach ($this->childs as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }

        return $sections;
    }
    public function books() {
        return $this->hasManyThrough(Book::class, Category::class, 'parent_id', 'category_id', 'id');
    }
}


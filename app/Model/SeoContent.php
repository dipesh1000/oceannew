<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SeoContent extends Model
{
    protected $fillable=['seoable_id', 'seoable_type', 'img_alt', 'img_title', 'meta_keyword', 'meta_description'];

    protected $casts = [
        'meta_keyword' => 'array',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}

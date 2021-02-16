<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{

    protected $guarded = [];
    protected $fillable = [
        'package_id',
        'itemable_id',
        'itemable_type',
    ];

    public function itemable()
    {

        return $this->morphTo();
    }


    public function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }

}

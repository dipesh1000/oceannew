<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItem()
    {
        return $this->morphTo();
    }
}

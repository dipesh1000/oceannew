<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItem()
    {
        return $this->morphTo();
    }

    public function master_order()
    {
        return $this->belongsTo(MasterOrder::class,'master_order_id');
    }
}

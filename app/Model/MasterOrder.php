<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MasterOrder extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    const STATUS_CHECKOUT  = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_BLOCKED = 5;

    public static function listStatus()
    {
        return [
            self::STATUS_ACTIVE    => 'Active',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_CHECKOUT  => 'Check Out',
            self::STATUS_CANCELLED  => 'Cancelled',
            self::STATUS_BLOCKED  => 'Blocked'
        ];
    }

    public function statusLabel()
    {
        $list = self::listStatus();
        // little validation here just in case someone mess things
        // up and there's a ghost status saved in DB
        return isset($list[$this->status])
            ? $list[$this->status]
            : $this->status;
    }
    public function orderItem()
    {
        return $this->morphMany(Order::class, 'purchaseble');
    }
    public function orderDetails()
    {
        return $this->hasMany(Order::class, 'master_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

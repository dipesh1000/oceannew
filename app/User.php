<?php

namespace App;

use App\Model\MasterOrder;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User  extends EloquentUser implements JWTSubject
{
    use AuthAuthenticatable,Notifiable;
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function myOrder()
    {
        return $this->hasMany(MasterOrder::class,'user_id','id');
    }
}

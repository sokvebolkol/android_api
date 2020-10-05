<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['phone','address','user_image','token','name','another_phone'];

    public function propertyposts(){

        return $this->hasMany(PropertyPost::class);
    }


    // public function propertyorders(){

    //     return $this->hasMany(PropertyOrder::class);
    // }

    public function roles(){

        return $this->belongsToMany(Role::class,"user_roles");
    }
}

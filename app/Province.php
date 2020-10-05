<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['province_name'];

    // public function propertyposts(){

    //     return $this->hasMany(PropertyPost::class);
    // }

    public function districts(){

        return $this->hasMany(District::class);
    }
}

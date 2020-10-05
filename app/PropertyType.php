<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = ['property_name'];

    public function propertyposts(){

        return $this->hasMany(PropertyPost::class);
    }
}

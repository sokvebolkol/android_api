<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = ['img_path','property_post_id'];

    public function propertypost(){
        return $this->belongsTo(PropertyPost::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationProperty extends Model
{
    protected $fillable = ['property_post_id','user_device'];

    public function propertypost(){

        return $this->belongsTo(PropertyPost::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPost extends Model
{
    protected $fillable = ['price','land_width','land_height','width','height','type_villa','bathroom_number',
    'bedroom_number','phone_number1','phone_number2','duration','latitude','property_name',
    'longitude','description','post_view','status','check_status_property','is_deleted','user_id','property_type_id','district_id','paid'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function propertytype(){
        return $this->belongsTo(PropertyType::class);
    }


    public function propertyimages(){

        return $this->hasMany(PropertyImage::class);
    }


    public function district(){
        return $this->belongsTo(District::class);
    }


    public function notificationproperty(){
        return $this->hasOne(NotificationProperty::class);
    }


    public function propertyorders(){
        return $this->hasMany(PropertyOrder::class);
    }
}

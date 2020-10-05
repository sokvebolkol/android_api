<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyOrder extends Model
{
    protected $fillable = ['transaction_id','service_fee','status','message','error_code','is_deleted','user_id','property_post_id','gateway_type_id'];


    public function gatewaytype(){
        return $this->belongsTo(GatewayType::class);
    }


    public function propertypost(){
        return $this->belongsTo(PropertyPost::class);
    }


    // public function user(){

    //     return $this->belongsTo(User::class);
    // }
}

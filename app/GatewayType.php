<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewayType extends Model
{
    protected $fillable = ['gateway_name'];

    public function propertyorders(){
        return $this->hasMany(PropertyOrder::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['district_name','province_id'];

    public function province(){

        return $this->belongsTo(Province::class);
    }
}

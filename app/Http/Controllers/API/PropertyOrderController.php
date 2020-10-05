<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PropertyOrder;

class PropertyOrderController extends Controller
{
    public function createOrder(Request $req){
        $input = $req->all();

        $user_id = DB::table('users')->where('token',$input["token"])->first()->id;

        $property_order = new PropertyOrder();
        
    }
}

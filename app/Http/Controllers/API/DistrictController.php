<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{

    public function getDistrict(Request $req){

        $input = $req->all();

        // dd($input["province_name"]);

        $pid = DB::table('provinces')
                ->select('id')
                ->where('province_name','=',$input["province_name"])
                ->get();

        foreach ($pid as $pd) {
            # code...

            $id = $pd->id;
        }



        // dd($id);

        $districts = DB::table('districts')
                    ->join('provinces','districts.province_id','=','provinces.id')
                    ->select('districts.district_name')
                    ->where('districts.province_id','=',$id)
                    ->get();


        $arr = array();

        foreach ($districts as $d) {

            array_push($arr,$d->district_name);
        }


        // $respone["data"] = $arr;

        $respone["district"] = $arr;

        return response()->json($respone,200);
    }
}

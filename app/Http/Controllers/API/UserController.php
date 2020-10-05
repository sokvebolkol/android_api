<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PropertyImage;
use App\User;
use App\UserRole;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\File;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function createUser(Request $req){

        try{

            $input = $req->all();

            $users = DB::table('users')->where('phone',$input["phone"])->first();

           if ($users){
               $user_id = $users->id;
               $user = User::find($user_id);
               $user->token = $input["token"];
               $user->save();
               $response["message"] = "Update user token success";
           }else{
               $user = new User();
               $user->phone = $input["phone"];
               $user->token = $input["token"];
               $user->save();
               $response["message"] = "Create new user Success";
           }


            $response["status"] = true;


        }catch(Exception $ex){
            $response["status"] = false;
            $response["message"] = "$ex";


        }

        return response()->json($response,200);

    }



    public function updateUser(Request $req, $tk){

        try{

            $input = $req->all();

            $user_id = DB::table('users')->where('token',$tk)->first()->id;

            $user = User::find($user_id);

            $user->name = $input["name"];
            $user->address = $input["address"];
            $user->user_image = $input["user_image"];
            $user->another_phone = $input["another_phone"];

            $user->save();


            $response["status"] = true;
            $response["message"] = "Update Success";
            $response["user"] = $user;

        }catch(Exception $ex){
            $response["status"] = false;
            $response["message"] = "$ex";
            $response["user"] = null;
        }


        return response()->json($response,200);
    }

    public function test(Request $req){

        $input = $req->all();

        $image = $input["img"];  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        // move_uploaded_file($imageName,"/uploads/$imageName");
        // $extension = $imageName->getClientOriginalExtension();
        // Storage::disk('public')->put($imageName->getFilename().'.'.$extension,  File::get($imageName));
        Storage::disk('local')->put($imageName, base64_decode($image));


        // \File::put(storage_path().'/'. $imageName, base64_decode($image));


        return response()->json(["image"=>"Successful"]);

        // // $response["Image"] = $image;


        // return response()->json($response,200);
    }



    public function upload(Request $req){

        $arr = array("Image1","Image2");

        $input = $req->all();
        $pid = $input["property_post_id"];

        foreach ($arr as $k=>$v) {

            PropertyImage::create([
                "img_path" => $v,
                "property_post_id" => $pid
            ]);
        }

        $response["success"] = "true";
        $response["message"] = "Successful Uploaded";

        return response()->json($response,200);
    }


    public function checkOwnPostUser(Request $req){

        $input = $req->all();

        $user_id = DB::table('users')->where('token',$input["token"])->first()->id;

        $property_post_user = DB::table('property_posts')->where('user_id',$user_id)->first();

        if ($property_post_user){
            $response["message"] = "true";
        }else
        {
            $response["message"] = "false";
        }

        return response()->json($response,200);
    }
}

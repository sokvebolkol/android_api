<?php

namespace App\Http\Controllers\API;


use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NotificationProperty;
use App\PropertyImage;
use App\PropertyOrder;
use App\PropertyPost;
use App\PropertyType;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PropertyPostController extends Controller
{


   // create a new PostProperty
    public function createPropertyPost(Request $request)
    {
        $type_property = $request->type;
        $propertytype_id = DB::table('property_types')->where('property_type', $type_property)->first()->id;
        $district_id = DB::table('districts')->where('district_name', $request->district)->first()->id;
        $input = $request->all();
        $user_id = DB::table('users')->where('token',$input["token"])->first()->id;

    if( $type_property == "Land" ){
            $propertypost = PropertyPost::create([
            "price" => $input["price"],
            "land_width" => $input["land_width"],
            "land_height" => $input["land_height"],
            "phone_number1" => $input["phone_number1"],
            "phone_number2" => $input["phone_number2"],
            "duration" => $input["duration"],
            "description" => $input["description"],
            "latitude" => $input["latitude"],
            "longitude" => $input["longitude"],
           // "check_status_property" => $input["check_status_property"],
            "status" => $input["status"],
           // "post_view" => $input["post_view"],
            "property_type_id" => $propertytype_id,
            "district_id"=>$district_id,
            "user_id" => $user_id
            ]);
            NotificationProperty::create([
                "property_post_id"=>$propertypost->id
            ]);

            PropertyOrder::create([
                "property_post_id"=>$propertypost->id,
                "user_id"=>$user_id
            ]);

            //uploud multiple images in to database and folder estate_imgs in laravel

            $img = $input["img_path"];

            foreach ($img as $k=>$v) {
                $image = $v;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));

                PropertyImage::create([
                    "img_path" => $imageName,
                    "property_post_id" => $propertypost->id
                ]);

            }


            $response["message"] = "Create Post Successful";
            $response["post_id"] = $propertypost->id;
            return response()->json($response);
        }

    else if( $type_property == "Condo" ){

            $propertypost = PropertyPost::create([
                "property_name" => $input["property_name"],
                "price" => $input["price"],
                "property_name" => $input["property_name"],
                // "land_width" => $input["land_width"],
                // "land_height" => $input["land_height"],
                "width" => $input["width"],
                "height" => $input["height"],
                "bathroom_number" => $input["bathroom_number"],
                "bedroom_number" => $input["bedroom_number"],
                "phone_number1" => $input["phone_number1"],
                "phone_number2" => $input["phone_number2"],
                "duration" => $input["duration"],
                "description" => $input["description"],
                "latitude" => $input["latitude"],
                "longitude" => $input["longitude"],
                //"check_status_property" => $input["check_status_property"],
                "status" => $input["status"],
               // "post_view" => $input["post_view"],
                "property_type_id" => $propertytype_id,
                "district_id"=>$district_id,
                "user_id" => $user_id
            ]);

            NotificationProperty::create([
                "property_post_id"=>$propertypost->id
            ]);

            PropertyOrder::create([
                "property_post_id"=>$propertypost->id,
                "user_id"=>$user_id
            ]);

            $img = $input["img_path"];

            foreach ($img as $k=>$v) {
                $image = $v;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));

                PropertyImage::create([
                    "img_path" => $imageName,
                    "property_post_id" => $propertypost->id
                ]);
            }

            $response["message"] = "Create Post Successful";
            $response["post_id"] = $propertypost->id;
            return response()->json($response);

        }
    else if( $type_property == "House" ){
            $propertypost = PropertyPost::create([

                "price" => $input["price"],
                "land_width" => $input["land_width"],
                "land_height" => $input["land_height"],
                "width" => $input["width"],
                "height" => $input["height"],
                "bathroom_number" => $input["bathroom_number"],
                "bedroom_number" => $input["bedroom_number"],
                "phone_number1" => $input["phone_number1"],
                "phone_number2" => $input["phone_number2"],
                "duration" => $input["duration"],
                "description" => $input["description"],
                "latitude" => $input["latitude"],
                "longitude" => $input["longitude"],
               // "check_status_property" => $input["check_status_property"],
                "status" => $input["status"],
                //"post_view" => $input["post_view"],
                "property_type_id" => $propertytype_id,
                "district_id"=>$district_id,
                "user_id" => $user_id
            ]);

            NotificationProperty::create([
                "property_post_id"=>$propertypost->id
            ]);

            PropertyOrder::create([
                "property_post_id"=>$propertypost->id,
                "user_id"=>$user_id
            ]);

            //uploud multiple images in to database and folder estate_imgs in laravel
            $img = $input["img_path"];

            foreach ($img as $k=>$v) {

                $image = $v;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));

                PropertyImage::create([
                    "img_path" =>$imageName,
                    "property_post_id" => $propertypost->id
                ]);
            }


            $response["message"] = "Create Post Successful";
            $response["post_id"] = $propertypost->id;
            return response()->json($response);

        }
    else if( $type_property == "Building" ){
            $propertypost = PropertyPost::create([
                "property_name" => $input["property_name"],
                "price" => $input["price"],
                "property_name" => $input["property_name"],
                // "land_width" => $input["land_width"],
                // "land_height" => $input["land_height"],
                "width" => $input["width"],
                "height" => $input["height"],
                "bathroom_number" => $input["bathroom_number"],
                "bedroom_number" => $input["bedroom_number"],
                "phone_number1" => $input["phone_number1"],
                "phone_number2" => $input["phone_number2"],
                "duration" => $input["duration"],
                "description" => $input["description"],
                "latitude" => $input["latitude"],
                "longitude" => $input["longitude"],
               // "check_status_property" => $input["check_status_property"],
                "status" => $input["status"],
                //"post_view" => $input["post_view"],
                "property_type_id" => $propertytype_id,
                "district_id"=>$district_id,
                "user_id" => $user_id
            ]);

            NotificationProperty::create([
                "property_post_id"=>$propertypost->id
            ]);

            PropertyOrder::create([
                "property_post_id"=>$propertypost->id,
                "user_id"=>$user_id
            ]);

            //uploud multiple images in to database and folder estate_imgs in laravel

            $img = $input["img_path"];

            foreach ($img as $k=>$v) {

                $image = $v;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));

                PropertyImage::create([
                    "img_path" => $imageName,
                    "property_post_id" => $propertypost->id
                ]);
            }



            $response["message"] = "Create Post Successful";
            $response["post_id"] = $propertypost->id;
            return response()->json($response);
        }

    else if( $type_property = "Villa" ){

            $propertypost = PropertyPost::create([

                "price" => $input["price"],
                "property_name" => $input["property_name"],
                // "land_width" => $input["land_width"],
                // "land_height" => $input["land_height"],
                "width" => $input["width"],
                "height" => $input["height"],
                "type_villa" => $input["type_villa"],
                "bathroom_number" => $input["bathroom_number"],
                "bedroom_number" => $input["bedroom_number"],
                "phone_number1" => $input["phone_number1"],
                "phone_number2" => $input["phone_number2"],
                "duration" => $input["duration"],
                "description" => $input["description"],
                "latitude" => $input["latitude"],
                "longitude" => $input["longitude"],
                //"check_status_property" => $input["check_status_property"],
                "status" => $input["status"],
                //"post_view" => $input["post_view"],
                "property_type_id" => $propertytype_id,
                "district_id"=>$district_id,
                "user_id" => $user_id
            ]);

            NotificationProperty::create([
                "property_post_id"=>$propertypost->id
            ]);

            PropertyOrder::create([
                "property_post_id"=>$propertypost->id,
                "user_id"=>$user_id
            ]);
            //uploud multiple images in to database and folder estate_imgs in laravel
            $img = $input["img_path"];

            foreach ($img as $k=>$v) {
                $image = $v;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));

                PropertyImage::create([
                    "img_path" => $imageName,
                    "property_post_id" => $propertypost->id
                ]);
            }

            $response["message"] = "Create Post Successful";
            $response["post_id"] = $propertypost->id;
            return response()->json($response);
        }
    }


// hide post
    public function deletePost(Request $request,$id)
    {

        $hide_post = PropertyPost::where('id',$id)->first();
        $hide_post->is_deleted = '1';
        $hide_post->check_status_property = $request->status_delete;
        $hide_post->save();
        return response()->json(["message"=>"Delete Sucessful"]);
    }

// seacher property
    public function searchProperty(Request $request)
    {

        $input = $request->all();//get all input from user input
        $query = "SELECT post.id as id, post.price as price, post.district_id as district_id, post.user_id as user_id, post.post_view as post_view, post.status as status, post.created_at as created_at, post.property_type_id as property_type_id ,post.is_deleted as is_deleted,
         post.latitude as latitude, post.longitude as longitude, post.paid as paid ".
                "FROM property_posts post, districts dis, provinces pro, ".
                "property_types prt ".
                "WHERE(post.district_id = dis.id ".
                "AND post.property_type_id = prt.id ".
                "AND dis.province_id = pro.id) ".
                "AND (prt.property_type = '".$input["type"]."' ".
                "AND pro.province_name = '".$input["province"]."' ".
                "AND post.status = '".$input["status"]."'".
                "AND post.is_deleted = '0' ".
                "AND post.paid = '1' ".
                "AND ((post.price >= ".$input["price_min"].")"."AND (post.price <= ".$input["price_max"]."))
                )";
                // "OR (prt.property_type = '".$input["type"]."' ".
                // "AND pro.province_name = '".$input["province"]."' ".
                // "AND post.status = '".$input["status"]."'".
                // "AND post.is_deleted = '0' ".
                // "AND ((post.price != ".$input["price_min"].")"."AND (post.price != ".$input["price_max"]."))))";
        $search = DB::select( DB::raw($query) );


            $response = array();

            foreach($search as $value){

                $property_id = $value->id;
                $district_id = $value->district_id;
                $price = $value->price;
                $user_id = $value->user_id;
                $status = $value->status;
                $lat = $value->latitude;
                $long = $value->longitude;
               // $time = $value->created_at;
                $view_post = $value->post_view;
                // $time = $value->created_at;

                //get created_at
               $time = PropertyPost::where('id',$property_id)->first()->created_at;
                //get property_type
                $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                //get province
                $province =District::where('id',$district_id)->first()->province()->first()->province_name;

                //get district
                $district =District::where('id',$district_id)->first()->district_name;

                // img things
                $img_loc = PropertyImage::where('property_post_id',$value->id)->first()->img_path;

                $tmp = array(
                    "user_id"=>$user_id,
                    "property_post_id"=>$property_id,
                    "location"=> $province,
                    "district"=>$district,
                    "time"=> $time->diffForHumans(),
                    "price"=>"$".number_format($price),
                    "post_view"=>$view_post." views",
                    "property_type"=> $property_type,
                    "status"=>$status,
                    "priceD"=>$price,
                    "lat"=>$lat,
                    "long"=>$long,
                   "img" => $img_loc

                );
                $response[] = $tmp;
            }

            return response()->json(['searchdata'=> $response]);

    }

// analyze property
    public function analyzeProperty(Request $request){

        $input = $request->all();//get all input from user input
        $query = "SELECT post.id as id, post.price as price, post.district_id as district_id, post.user_id as user_id, post.post_view as post_view, post.status as status, post.created_at as created_at, post.property_type_id as property_type_id ,post.is_deleted as is_deleted,
        post.latitude as latitude, post.longitude as longitude, post.paid as paid ".
                "FROM property_posts post, districts dis, provinces pro, ".
                "property_types prt ".
                "WHERE(post.district_id = dis.id ".
                "AND post.property_type_id = prt.id ".
                "AND dis.province_id = pro.id) ".
                "AND (prt.property_type = '".$input["type"]."' ".
                "AND dis.district_name = '".$input["district"]."' ".
                "AND post.status = '".$input["status"]."'".
                "AND post.is_deleted = '0' ".
                "AND post.paid = '1' ".
                "AND (post.price = ".$input["price"]."))";
        $search = DB::select( DB::raw($query) );


            $response = array();

            foreach($search as $value){

                $property_id = $value->id;
                $district_id = $value->district_id;
                $price = $value->price;
                $user_id = $value->user_id;
                $status = $value->status;
                $view_post = $value->post_view;
                $lat = $value->latitude;
                $long = $value->longitude;

                //get created_at
                $time = PropertyPost::where('id',$property_id)->first()->created_at;

                //get property_type
                $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                //get province
                $province =District::where('id',$district_id)->first()->province()->first()->province_name;

                $district =District::where('id',$district_id)->first()->district_name;

                // img things
                $img_loc = PropertyImage::where('property_post_id',$property_id)->first()->img_path;




                $tmp = array(
                    "user_id"=>$user_id,
                    "property_post_id"=>$property_id,
                    "location"=> $province,
                    "district"=>$district,
                    "time"=> $time->diffForHumans(),
                    "price"=>"$".number_format($price),
                    "post_view"=>$view_post." views",
                    "property_type"=> $property_type,
                    "status"=>$status,
                    "priceD"=>$price,
                    "lat"=>$lat,
                    "long"=>$long,
                   "img" => $img_loc

                );
                $response[] = $tmp;
            }

        return response()->json(['data'=> $response]);
    }

    // check pay post
    function paid(Request $request)
    {
        $input = $request->all();
        $paid_post = PropertyPost::where('id',$input["post_id"])->first();
        $paid_post->paid = '1';
        $paid_post->save();
    }

// view property list

    function viewPropertyList(Request $request)
    {
        $input = $request->all();

        try{
            $getdata = PropertyPost::where('status',$input["status"])
                                    ->where('is_deleted','0')
                                    ->where('paid','1')
                                    ->orderBy('created_at', 'DESC')->get();


            $response = array();

            foreach($getdata as $value){

                $property_id = $value->id;
                $district_id = $value->district_id;
                $price = $value->price;
                $user_id = $value->user_id;
                $time = $value->created_at->diffForHumans();
                $view_post = $value->post_view;
                $status = $value->status;
                $lat = $value->latitude;
                $long = $value->longitude;

                //get property_type
                $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                //get province
                $province =District::where('id',$district_id)->first()->province()->first()->province_name;
                //get district
                $district =District::where('id',$district_id)->first()->district_name;
                // img things
                $img_loc = PropertyImage::where('property_post_id',$property_id)->first()->img_path;


                $tmp = array(
                    "user_id"=>$user_id,
                    "property_post_id"=>$property_id,
                    "location"=> $province,
                    "district"=>$district,
                    "time"=> $time,
                    "price"=>"$".number_format($price),
                    "post_view"=>$view_post." views",
                    "property_type"=> $property_type,
                    "status"=>$status,
                    "priceD"=>$price,
                    "lat"=>$lat,
                    "long"=>$long,
                   "img" => $img_loc
                );
                $response[] = $tmp;
            }

        }catch(Exception $ex){

            $response["status"] = false;
            $response["message"] = "$ex";
            $response["data"] = null;

        }

        return response()->json(["data"=>$response],200);
    }

    function viewPropertyPostHistory(Request $request)
    {

        try{
            $user_id = DB::table('users')->where('token',$request->token)->first()->id;

            $getdata = PropertyPost::where('user_id',$user_id)
                        ->where('is_deleted','0')
                        ->where('paid','1')
                        ->orderBy('created_at', 'DESC')->get();



            $response = array();

            foreach($getdata as $value){

                $property_id = $value->id;
                $district_id = $value->district_id;
                $price = $value->price;
                $status = $value->status;
                $time = $value->created_at->diffForHumans();
                $view = $value->post_view;
                $type = $value->property_type_id;
                $duration = $value->duration;
                $lat = $value->latitude;
                $lng = $value->longitude;


                $property_type = PropertyType::where('id',$type)->first()->property_type;

                //get province
                $province =District::where('id',$district_id)->first()->province()->first()->province_name;
                $district = District::where('id',$district_id)->first()->district_name;

                // img things
                $img_loc = PropertyImage::where('property_post_id',$property_id)->first()->img_path;


                $tmp = array(

                    "property_post_id"=>$property_id,
                    "location"=> $province,
                    "price"=>"$".number_format($price),
                    "time"=>$time,
                    "view_post"=>$view." views",
                    "status"=>$status,
                    "img" => $img_loc,
                    "property_type"=> $property_type,
                    "duration"=>$duration,
                    "district_name"=>$district,
                    "latitude"=>$lat,
                    "longitude"=>$lng

                );

                $response[] = $tmp;

            }
        }catch(Exception $ex){

            $response["status"] = false;
            $response["message"] = "$ex";
            $response["data"] = null;

        }



        return response()->json(["historyPost"=>$response],200);
    }


    function viewPropertyPostDetial(Request $request)
    {


           // $user_id = DB::table('users')->where('token',$request->token)->first()->id;
            //->where('user_id',$user_id)
            $getdata = PropertyPost::all()->where('id',$request->post_id);

            foreach($getdata as $value)
            {
                // $value->post_view = $value->post_view + 1;
                // $value->save();

                $property_id = $value->id;
                $district_id = $value->district_id;
                $user_id = $value->user_id;
                $price = $value->price;
                $status = $value->status;
                $bathroom = $value->bathroom_number;
                $bedroom = $value->bedroom_number;
                $phone1 = $value->phone_number1;
                $phone2 = $value->phone_number2;
                $width = $value->width;
                $height = $value->height;
                $land_width = $value->land_width;
                $land_height = $value->land_height;
                $description = $value->description;
                $lat = $value->latitude;
                $long = $value->longitude;
                $property_name = $value->property_name;
            // $time = $value->created_at->diffForHumans();

                //get user name
                $user_name = User::where("id",$user_id)->first()->name;
                //get property_type
                $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                //get province
                $province =District::where('id',$district_id)->first()->province()->first()->province_name;

                //get district
                $district =District::where('id',$district_id)->first()->district_name;
                // // img things
                // $img_loc = User::where('id',$user_id)->first()->user_image;
                // $img_loc = '/storage/estate_imgs/'.$img_loc;
                // // get image from

                $imgs = PropertyImage::where('property_post_id',$property_id)->get();
                $imgs_loc = array();

                foreach($imgs as $img){
                    $imgs_loc[] = $img->img_path;
                }

                $tmp = array(
                    "user_name"=>$user_name,
                    "user_id"=>$user_id,
                    "property_post_id"=>$property_id,
                    "province"=> $province,
                    "district"=> $district,
                    "price"=>$price,
                    "property_type"=> $property_type,
                    "bathroom"=>$bathroom,
                    "bedroom"=>$bedroom,
                    "house_width"=>$width,
                    "house_height"=>$height,
                    "property_name"=>$property_name,
                    //"land_size"=>$land_width,
                    "land_width"=>$land_width,
                    "land_height"=>$land_height,
                    "description"=>$description,
                    "lat"=>$lat,
                    "long"=>$long,
                    "phone1"=>$phone1,
                    "phone2"=>$phone2,
                    "status"=>$status,
                    // "user_img" => $img_loc,
                     "property_imgs" => $imgs_loc
                );
               // $response[] = $tmp;
        }
        return response()->json($tmp);
    }

    public function destroyImagePath($id)
    {
        $images = PropertyImage::where('property_post_id',$id)->get();
        foreach($images as $img){
            $image_path = public_path().'/'.$img->img_path;
            File::delete($image_path);
            $img->delete();
        }
    }

    public function deleteImage(Request $request)
    {
        $img_path = $request["img_path"];
        $images = PropertyImage::where('img_path',$img_path)->get();
        foreach($images as $img){
            $image_path = public_path().'/'.$img->img_path;
            File::delete($image_path);
            $img->delete();
        }
        return response()->json(['message'=> "delete successful"]);
    }

    function editPropertyPost(Request $request,$id)
    {
        $img = $request["img_path"];
        $old_imgs = $request["old_images"];

        $propertytype_id = DB::table('property_types')->where('property_type', $request->type)->first()->id;
        $district_id = DB::table('districts')->where('district_name', $request->district)->first()->id;
        $value = PropertyPost::find($id);
        // if($img != null){
        //     $this->destroyImagePath($id);
        // }
        if($request->type=="Land"){
            $value->district_id = $district_id;
            $value->duration = $request->duration;
            $value->price = $request->price;
            $value->status = $request->status;
            $value->phone_number1 = $request->phone_number1;
            $value->phone_number2 = $request->phone_number2;
            $value->land_width = $request->land_width;
            $value->land_height = $request->land_height;
            $value->description = $request->description;
            $value->latitude = $request->latitude;
            $value->longitude = $request->longitude;
            $value->property_type_id = $propertytype_id;
            $value->save();
        }
        else if($request->type=="Villa"){
            $value->district_id = $district_id;
            $value->duration = $request->duration;
            $value->type_villa = $request->type_villa;
            $value->price = $request->price;
            $value->status = $request->status;
            $value->bathroom_number = $request->bathroom_number;
            $value->bedroom_number = $request->bedroom_number;
            $value->phone_number1 = $request->phone_number1;
            $value->width = $request->width;
            $value->height = $request->height;
            $value->description = $request->description;
            $value->latitude = $request->latitude;
            $value->longitude = $request->longitude;
            $value->property_type_id = $propertytype_id;
            $value->save();
        }
        else if($request->type=="Condo"){
            $value->district_id = $district_id;
            $value->duration = $request->duration;
            $value->property_name = $request->property_name;
            $value->price = $request->price;
            $value->status = $request->status;
            $value->bathroom_number = $request->bathroom_number;
            $value->bedroom_number = $request->bedroom_number;
            $value->phone_number1 = $request->phone_number1;
            $value->width = $request->width;
            $value->height = $request->height;
            $value->description = $request->description;
            $value->latitude = $request->latitude;
            $value->longitude = $request->longitude;
            $value->property_type_id = $propertytype_id;
            $value->save();
        }
        else if($request->type=="House"){
            $value->district_id = $district_id;
            $value->duration = $request->duration;
            $value->price = $request->price;
            $value->status = $request->status;
            $value->bathroom_number = $request->bathroom_number;
            $value->bedroom_number = $request->bedroom_number;
            $value->phone_number1 = $request->phone_number1;
            $value->width = $request->width;
            $value->height = $request->height;
            $value->land_width = $request->land_width;
            $value->land_height = $request->land_height;
            $value->description = $request->description;
            $value->latitude = $request->latitude;
            $value->longitude = $request->longitude;
            $value->property_type_id = $propertytype_id;
            $value->save();
        }

        else if($request->type=="Building"){
            $value->district_id = $district_id;
            $value->duration = $request->duration;
            $value->property_name = $request->property_name;
            $value->price = $request->price;
            $value->status = $request->status;
            $value->bathroom_number = $request->bathroom_number;
            $value->bedroom_number = $request->bedroom_number;
            $value->phone_number1 = $request->phone_number1;
            $value->width = $request->width;
            $value->height = $request->height;
            $value->land_width = $request->land_width;
            $value->land_height = $request->land_hight;
            $value->description = $request->description;
            $value->latitude = $request->latitude;
            $value->longitude = $request->longitude;
            $value->property_type_id = $propertytype_id;

            $value->save();

        }
        if($img != null){
            foreach ($img as $k=>$v) {
                $image = $v;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));

                PropertyImage::create([
                    "img_path" => $imageName,
                    "property_post_id" => $value->id
                ]);
            }
        }
        return response()->json(['message'=>'Successful']);
    }


    function viewDetial(Request $request)
    {

            $type_propertye = $request->type;
           // $user_id = DB::table('users')->where('token',$request->token)->first()->id;
            //->where('user_id',$user_id)

            $getdata = PropertyPost::all()->where('id',$request->post_id)
                                          ->where('is_deleted','0');

            if( $type_propertye == "Land"){
                foreach($getdata as $value)
                {
                    $value->post_view = $value->post_view + 1;
                    $value->save();

                    $property_id = $value->id;
                    $district_id = $value->district_id;
                    $user_id = $value->user_id;
                    $price = $value->price;
                    $status = $value->status;
                    $bathroom = $value->bathroom_number;
                    $bedroom = $value->bedroom_number;
                    $phone1 = $value->phone_number1;
                    $phone2 = $value->phone_number2;
                    $width = $value->width;
                    $height = $value->height;
                    $land_width = $value->land_width;
                    $land_height = $value->land_height;
                    $description = $value->description;
                    $lat = $value->latitude;
                    $long = $value->longitude;
                   // $property_name = $value->property_name;
                // $time = $value->created_at->diffForHumans();

                    //get user name
                    $user_name = User::where("id",$user_id)->first()->name;
                    //get property_type
                    $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                    //get province
                    $province =District::where('id',$district_id)->first()->province()->first()->province_name;

                    //get district
                    $district =District::where('id',$district_id)->first()->district_name;
                    // // img things
                     $img_loc = User::where('id',$user_id)->first()->user_image;
                    // $img_loc = '/storage/estate_imgs/'.$img_loc;
                    // // get image from
                    $imgs = PropertyImage::where('property_post_id',$property_id)->get();
                    $imgs_loc = array();
                    foreach($imgs as $img){
                        $imgs_loc[] = $img->img_path;
                    }

                    $tmp = array(
                        "user_name"=>$user_name,
                        "user_id"=>$user_id,
                        "property_post_id"=>$property_id,
                        "province"=> $province,
                        "district"=> $district,
                        "price"=>"$".number_format($price),
                        "bathroom"=>"0"." bathrooms",
                        "bedroom"=>"0"." bedrooms",
                        "house"=>"0"."m"." x "."0"."m",
                        "land"=>$land_width."m"." x ".$land_height."m",
                        "description"=>$description,
                        "lat"=>$lat,
                        "long"=>$long,
                        "phone1"=>$phone1,
                        "phone2"=>$phone2,
                        "status"=>$property_type." ".$status,
                         "user_img" => $img_loc,
                         "property_imgs" => $imgs_loc
                    );
                   // $response[] = $tmp;
            }
            return response()->json($tmp);
            }

            if( $type_propertye == "House"){
                foreach($getdata as $value)
                {
                    $value->post_view = $value->post_view + 1;
                    $value->save();

                    $property_id = $value->id;
                    $district_id = $value->district_id;
                    $user_id = $value->user_id;
                    $price = $value->price;
                    $status = $value->status;
                    $bathroom = $value->bathroom_number;
                    $bedroom = $value->bedroom_number;
                    $phone1 = $value->phone_number1;
                    $phone2 = $value->phone_number2;
                    $width = $value->width;
                    $height = $value->height;
                    $land_width = $value->land_width;
                    $land_height = $value->land_height;
                    $description = $value->description;
                    $lat = $value->latitude;
                    $long = $value->longitude;
                   // $property_name = $value->property_name;
                // $time = $value->created_at->diffForHumans();

                    //get user name
                    $user_name = User::where("id",$user_id)->first()->name;
                    //get property_type
                    $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                    //get province
                    $province =District::where('id',$district_id)->first()->province()->first()->province_name;

                    //get district
                    $district =District::where('id',$district_id)->first()->district_name;
                    // // img things
                     $img_loc = User::where('id',$user_id)->first()->user_image;
                    // $img_loc = '/storage/estate_imgs/'.$img_loc;
                    // // get image from
                    $imgs = PropertyImage::where('property_post_id',$property_id)->get();
                    $imgs_loc = array();
                    foreach($imgs as $img){
                        $imgs_loc[] = $img->img_path;
                    }
                    $tmp = array(
                        "user_name"=>$user_name,
                        "user_id"=>$user_id,
                        "property_post_id"=>$property_id,
                        "province"=> $province,
                        "district"=> $district,
                        "price"=>"$".number_format($price),
                        "bathroom"=>$bathroom." bathrooms",
                        "bedroom"=>$bedroom." bedrooms",
                        "house"=>$width."m"." x ".$height."m",
                        "land"=>$land_width."m"." x ".$land_height."m",
                        "description"=>$description,
                        "lat"=>$lat,
                        "long"=>$long,
                        "phone1"=>$phone1,
                        "phone2"=>$phone2,
                        "status"=>$property_type." ".$status,
                         "user_img" => $img_loc,
                         "property_imgs" => $imgs_loc
                    );
                   // $response[] = $tmp;
            }
            return response()->json($tmp);
            }

            else{
                foreach($getdata as $value)
                {
                    $value->post_view = $value->post_view + 1;
                    $value->save();

                    $property_id = $value->id;
                    $district_id = $value->district_id;
                    $user_id = $value->user_id;
                    $price = $value->price;
                    $status = $value->status;
                    $bathroom = $value->bathroom_number;
                    $bedroom = $value->bedroom_number;
                    $phone1 = $value->phone_number1;
                    $phone2 = $value->phone_number2;
                    $width = $value->width;
                    $height = $value->height;
                    $land_width = $value->land_width;
                    $land_height = $value->land_height;
                    $description = $value->description;
                    $lat = $value->latitude;
                    $long = $value->longitude;
                   // $property_name = $value->property_name;
                // $time = $value->created_at->diffForHumans();

                    //get user name
                    $user_name = User::where("id",$user_id)->first()->name;
                    //get property_type
                    $property_type = PropertyType::where('id',$value->property_type_id)->first()->property_type;

                    //get province
                    $province =District::where('id',$district_id)->first()->province()->first()->province_name;

                    //get district
                    $district =District::where('id',$district_id)->first()->district_name;
                    // img things
                    $img_loc = User::where('id',$user_id)->first()->user_image;

                    // get image from
                    $imgs = PropertyImage::where('property_post_id',$property_id)->get();
                    $imgs_loc = array();
                    foreach($imgs as $img){
                        $imgs_loc[] = $img->img_path;
                    }

                    $tmp = array(
                        "user_name"=>$user_name,
                        "user_id"=>$user_id,
                        "property_post_id"=>$property_id,
                        "province"=> $province,
                        "district"=> $district,
                        "price"=>"$".number_format($price),
                        "bathroom"=>$bathroom." bathrooms",
                        "bedroom"=>$bedroom." bedrooms",
                        "house"=>$width."m"." x ".$height."m",
                        "land"=>"0"."m"." x "."0"."m",
                        "description"=>$description,
                        "lat"=>$lat,
                        "long"=>$long,
                        "phone1"=>$phone1,
                        "phone2"=>$phone2,
                        "status"=>$property_type." ".$status,
                        "user_img" => $img_loc,
                        "property_imgs" => $imgs_loc
                    );
                   // $response[] = $tmp;
            }
            return response()->json($tmp);
            }

        }

}

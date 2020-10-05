<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NotificationProperty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationPropertyController extends Controller
{

    public function viewNotification(Request $request){

         $input = $request->all();
        echo 'hello';
         $search = DB::table('notification_properties as nt')
                 -> join('property_posts as p','property_post_id','=','p.id')
               //  -> join('property_images as pi','property_post_id','=','pi.id')
               //  -> join('property_types as pt','pt.id','=','property_type_id')
                -> select('nt.id','p.price')
                // -> where('nt.property_post_id',$input['id'])
                ->get();

                return response()->json(['propertyPost'=>$search]);
    }

    public function sendNotification(Request $req){

        // $all_device = DB::table('notification_properties')->select('user_device')->get();

        $devices = ["ecVIoBy7_yg:APA91bHGRFyGhaMFVawP94Fs1ADrdTA5j6QBqtfDVq96rBSvIjJNzncYW0PxqQbHTyRWro2RUj_5Gt8CCgT_-2vYccubxRJKE0yQuD_73WrS0fUgUTL39Ayh_vzgxGc7L9WJnWznetav"
        ];

        // foreach ($all_device as $value) {
        //    $devices[] = $value->user_device;
        // }


        $input = $req->all();
        // dd($input["data"]);

        $fields = array(
            /*'to'             => $tokens,*/
            'registration_ids' => $devices,
            'priority'     => "high",
            'notification' => $input["data"],

       );

        return $this->sendPushNotification($fields);
    }

    private function sendPushNotification($data){


        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FIREBASE_API_KEY = "AAAAbX4lmTQ:APA91bHAXBUrhM2tDBT-904hZTuAEAEZJ42D3POVfN7g-q0S7OvTkkTy3rKwYgfVA7tbZrZlQTlYdvLoSEyu6E7Kb6Rz9ujiAA_sQy_H_v4ixRXcpPkGx7QEc29o1mSwi3UNl7zqyG6W";

        $headers = array(
            'Authorization: key=' . $FIREBASE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_IPRESOLVE,CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;


    }


    public function createUserTokenDevice(Request $req){

        $input = $req->all();

        $nt = new NotificationProperty();

        $nt->user_device = $input["user_device"];

        $nt->save();

        return response()->json(["status"=>"Upload Success"],200);

    }

}

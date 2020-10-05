<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PropertyPost;
use Exception;
use Stripe As Bongloy;

class PaymentController extends Controller
{
    public function bongloy(Request $req){
        Bongloy\Stripe::$apiBase = "https://api.bongloy.com";
        $input = "sk_test_hBq0S-SLpUZGyda_wPV_3Xp9SmKs9pOXEu4tSOSno_k";
        Bongloy\Stripe::setApiKey($input);

        $cardNumber = $req->number;
        $exp_m = (int)$req->exp_m;
        $exp_y = (int)$req->exp_y;
        $cvc = $req->cvc;
        $post_id = $req->post_id;

        // $paid_post = PropertyPost::where('id',$post_id)->first();
        // $paid_post->piad = '1';
        // $paid_post->save();

        try{
            $token = Bongloy\Token::create([
                'card' => [
                    'number' => $cardNumber,
                    'exp_month' =>$exp_m,
                    'exp_year' => $exp_y,
                    'cvc' => $cvc
                ]
            ]);

            try{
                $charge = Bongloy\Charge::create([
                    "amount" => 100,
                    "currency" => "usd",
                    "source" => $token
                ]);

                if ($charge["paid"]){
                    $response["status"] = true;
                    $response["message"] = "Payment Successfully";
                }else{
                    $response["status"] = false;
                    $response["message"] = "Payment Unsuccessfully";
                }

            }catch(Exception $ex){
                $response["status"] = false;
                $response["message"] = "Cannot Payment";
            }

        }catch(Exception $ex){
            $response["status"] = false;
            $response["message"] = "Invalid Card number";
        }

        return response()->json($response);
    }
}

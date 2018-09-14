<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\User;
use App\Content;
use App\ContentImg;



class CheckoutController extends Controller
{
    public function charge(Request $request){
        // dd($request->all());
        try {
            Stripe::setApiKey('sk_test_wuabzslGwSq91ILZojTz45HK');
            $token = $request->stripeToken;
            //ログインユーザー情報を取得
            $user_email = Auth::user()->email;


            // $customer = Customer::create([
            //     'email'=>$user_email,
            //     'source'=>$token
            // ]);
            // dd($customer);
            // tok_1DALHSDXeVxkPnaSrv5P7bDF

            $charge = Charge::create([
                "currency" => "jpy",
                'amount' =>$request->price,
                'description'=> 'サンプル決済',
                'source'=>$token,
                // 'customer'=>$customer->id,

            ]);


            $content_id = Content::find($request->id)->id;

            $file_path = storage_path()."/app/public/teaching_materials/" . $content_id.'/'. $request->file_name;

            return response()->download($file_path);
            return redirect('/content/show?id='.$request->id);


            // return 'Charge successful, you get the course!';
        } catch (\Exception $ex) {
            dd($ex);
            return $ex->getMessage();
        }

    }
}

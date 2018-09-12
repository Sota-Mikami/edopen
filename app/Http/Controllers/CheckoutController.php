<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function charge(Request $request){
        try {
            Stripe::setApiKey('sk_test_wuabzslGwSq91ILZojTz45HK');

            $customer = Customer::create([
                'email'=>$request->stripeEmail,
                'source'=>$request->stripeToken
            ]);

            $charge = Charge::create([
                'customer'=>$customer->id,
                'amount' =>1999,
                'currency'=>'usd',
            ]);

            return 'Charge successful, you get the course!';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }
}

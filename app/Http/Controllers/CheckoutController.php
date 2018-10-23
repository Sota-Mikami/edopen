<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailInformPayment;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\User;
use App\Content;
use App\ContentImg;



class CheckoutController extends Controller
{
    //決済メソッド
    public function charge(Request $request){
        try {
            Stripe::setApiKey('sk_test_wuabzslGwSq91ILZojTz45HK');
            $token = $request->stripeToken;
            //ログインユーザー情報を取得
            $user = User::find(Auth::user()->id);
            $user_email = $user->email;
            $content = Content::find($request->id);//コンテンツ情報取得

            //(API)STRIPEに顧客情報を保存
            $customer = Customer::create([
                'email'=>$user_email,
                'source'=>$token
            ]);

            //(API)STRIPEにて決済
            $charge = Charge::create([
                "currency" => "jpy",
                'amount' =>$request->price,
                'description'=> 'サンプル決済',
                'customer'=>$customer->id,
            ]);

            //メール送信
            $this->EmailInformPayment($content, $user_email);

            //購入履歴を更新
            $user->paid_content()->attach($content);

            //指定された教材コンテンツダウンロード
            $file_path = storage_path()."/app/public/teaching_materials/" . $content->id.'/'. $request->file_name;
            return response()->download($file_path);

            return redirect('/content/show?id='.$request->id);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


    //購入済みの教材コンテンツのダウンロード
    public function downloadContent($content_id, $file_name){
        $file_path = storage_path()."/app/public/teaching_materials/" . $content_id.'/'. $file_name;

        return response()->download($file_path);
    }

    //メールで購入情報をお知らせ
    private function EmailInformPayment($content ,$email){
        // dd($content);
        $mailer = new EmailInformPayment($content);

        Mail::to($email)->send($mailer);
    }



}

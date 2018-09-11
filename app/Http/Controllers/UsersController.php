<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\EmailVerification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRequest $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('user.register');
        return view('user.pre_register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $email = $request->email;
        //メールアドレスのローカルパートを取得
        //例：xxx@aaa.bbbのxxxの部分
        $localpart = substr($email,0, strpos($email,"@"));


        $user = User::create([
            'name' =>$localpart,
            'email'=>$email,
            'password'=>Hash::make($request->password),
            'email_verify_token' => base64_encode($email),
        ]);
        // dd($user);

        // 指定されたメールアドレスへユーザー確認メールを送信
        $mailer = new EmailVerification($user);
        // dd($mailer);
        // Mail::to($email)->send($mailer);
        Mail::to("uv.nkmt.yii@gmail.com")->send($mailer);


        // event(new Register($user = $this->createUser( $request->all() )));

        Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);
        return view('user.registered');

        // if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
        //     return redirect('/');
        // }
    }

    // public function createUser(array $data){
    //     $email = $data['email'];
    //     //メールアドレスのローカルパートを取得
    //     //例：xxx@aaa.bbbのxxxの部分
    //     $localpart = substr($email,0, strpos($email,"@"));
    //
    //
    //     $user = User::create([
    //         'name' =>$localpart,
    //         'email'=>$data['email'],
    //         'password'=>Hash::make($data['password']),
    //         'email_verify_token' => base64_encode($data['email']),
    //     ]);
    //
    //     // 指定されたメールアドレスへユーザー確認メールを送信
    //     $mailer = new EmailVerification($user);
    //     dd($mailer);
    //     Mail::to($user->email)->send($mailer);
    //
    //     return $user;
    // }


    public function showForm($email_token){
        Log::debug("========showForm==========");
        Log::debug($email_token);
        //使用可能なトークンか
        if (!User::where('email_verify_token' , $email_token)->exists()) {
            Log::debug("無効なトークンです。");
            return view('user.main.register')->with('message','無効なトークンです。');
        }else {
            $user = User::where('email_verify_token', $email_token)->first();
            Log::debug($user);
            //本登録ユーザーか
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
            {
                Log::debug("status".$user->status);
                Log::debug("すでに本登録されています。");
                $user->save();

                // if (Auth::attempt(['email'=>$user->email, 'password'=>Hash::make($user->password)])) {
                //     Log::debug("ログイン成功しました");
                //     return redirect('/');
                // }
                return redirect('/')->with('message','すでに本登録されています。ログインして、利用してください。');
            }

            //ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            Log::debug("status".$user->status);
            // $user->verify_at = Carbon::now();
            if ($user->save()) {
                Log::debug("ユーザーステータス更新しました");
                return redirect('/');
            }else {
                Log::debug("ユーザーステータス更新に失敗しました");
                return redirect('/');
            }
        }
    }



    public function mainRegister(Request $request){
        $user = User::where('email_verify_token',$request->email_token)->first();
        $user->status = config('const.USER_STATUS.REGISTER');
        $user->save();

        if (Auth::attempt(['email'=>$user->email, 'password'=>$user->password])) {
            return redirect('/');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit()
    {
        $user = User::find(Auth::user()->id);

        return view('user.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {

        // 認証済みのユーザーのみ、ユーザー情報をログインできるようにする
        $user = User::find(Auth::user()->id);

        $form = $request->all();
        unset($form['_token'],$form['profile_img']);
        $user->fill($form);
        if (!empty($request->profile_img)) {
            $user->img = $request->file('profile_img')->store('profile_images','public');
        }

        $user->save();

        return view('user.edit',['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



// ================================================
    // ユーザーのログイン・ログアウト処理
// ================================================


    public function getAuth(Request $request){
        $param = ['message'=>'ログインしてください。'];
        return view('user.login',$param);
    }


    public function postAuth(Request $request){
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email'=>$email, 'password'=>$password])) {
            return redirect('/');
        }

        return view('user.login', ['message'=>'ログインに失敗しました。']);
    }

    public function getLogout(){
        Auth::logout();//ログアウト
        //TODO:確認
        // $request->session()->flush();
        return redirect('/');
    }


    // ================================================
        //  その他ファンクション
    // ================================================

    public function uploadImg(){
        info('uploadImg');
    }













}

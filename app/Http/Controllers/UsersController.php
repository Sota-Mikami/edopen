<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\EmailVerification;
use App\Mail\UpdateEmail;
use App\Mail\AccountLock;
use App\Mail\UpdatePassword;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
// ↑ trait先を参照して、メソッドを使用できないのはなぜか？




class UsersController extends Controller
{
    use  ThrottlesLogins;

    //アカウントロック時間
    private $maxLoginAttempts = 10; //Login回数
    private $lockoutTime = 30; // 分



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

        // 指定されたメールアドレスへユーザー確認メールを送信
        $mailer = new EmailVerification($user);
        Mail::to($email)->send($mailer);

        Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);
        return view('user.registered');
    }


    public function showForm($email_token){
        //使用可能なトークンか
        if (!User::where('email_verify_token' , $email_token)->exists()) {
            return view('user.main.register')->with('message','無効なトークンです。');
        }else {
            $user = User::where('email_verify_token', $email_token)->first();
            //本登録ユーザーか
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
            {
                $user->save();

                return redirect('/')->with('message','すでに本登録されています。ログインして、利用してください。');
            }

            //ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            Log::debug("status".$user->status);
            if ($user->save()) {
                return redirect('/');
            }else {
                return redirect('/');
            }
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


    public function editEmail(){
        $user = Auth::user();
        return view('user.edit.email',['user'=>$user]);
    }

    public function updateEmail(Request $request){


        //バリデーション
        //1. ログインユーザーの現在のメールアドレス情報を取得
        //2. 入力されたEmailとデータベースのEmail 情報の照合
        //3. パスワードの本人確認
        //4. 『新しいメールアドレス』が『現在のメールアドレス』と同じになっていないか確認
        $user = User::find(Auth::user()->id);

        $rules = [
            'old_email' => 'required | email | auth_email',
            'password' => 'required | userPasswordCheck',
            'new_email'=>'required | email | existEmail',
        ];

        $messages = [
            'old_email.required' =>'メールアドレスを入力してください',
            'old_email.email' =>'メールアドレスを入力してください',
            'old_email.auth_email' =>'正しいメールアドレスではありません',
            'old_email.exist_email'=>'既に登録されているメールアドレスへ変更しようとしています',
            'new_email.required' =>'メールアドレスを入力してください',
            'new_email.email' =>'メールアドレスを入力してください',
            'new_email.exist_email'=>'既に登録されているメールアドレスへ変更しようとしています',
            'password.required' => 'パスワードは必ず入力してください',
            'password.user_password_check' => 'パスワードが正しくありません',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/user/email/edit')
                    ->withErrors($validator)
                    ->withInput();
        }


        //5. 上記（ 1 ~ 4 ）の要件を満たした場合にのみ、『新しいメールアドレス』へ本人確認メールを送信
        $mailer = new UpdateEmail;
        Mail::to($request->new_email)->send($mailer);

        //6. データベースへ反映
        $user->email = $request->new_email;
        $user->save();

        //（保留）6. 送信メールに記載しているURLトークンを確認してもらう

        //保存成功後、topページへリダイレクト
        return redirect('/');

    }

    //パスワードアップデート処理
    public function editPassword(){
        $user = Auth::user();
        return view('user.edit.password',['user'=>$user]);
    }

    public function updatePassword(Request $request){

        $user = User::find(Auth::user()->id);


        //パスワードにセットするバリデーションについて
        //1. 必須
        //2. 6文字未満
        //3. 確認項目と同じ文字列がセットされているのか
        //4. old_passwordと同じ値の場合に弾く

        $rules = [
                'old_password' =>'required | userPasswordCheck',
                'email' =>'required | email |  auth_email',
                'password' => 'required | min:6 | notUserPasswordCheck | notSameUserNameToPassword | confirmed ',
                'password_confirmation'=> 'required',
        ];


        $messages = [

        ];


        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return redirect('/user/password/edit')
                    ->withErrors($validator)
                    ->withInput();
        }


        //パスワード変更メール送信
        $mailer =  new UpdatePassword ;
        Mail::to($user->email)->send($mailer);


        //変更後のパスワードをDBへ反映
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect('/');
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

    //Login処理
    public function postAuth(Request $request){
        $email = $request->email;
        $password = $request->password;


        $throttles = $this->hasTooManyLoginAttempts($request);

        //10回以上ログインエラーにかかった場合
        if ($throttles) {
            //アカウントロックを実行
            $this->fireLockoutEvent($request);

            //ユーザーへメールを送信
            $mailer = new AccountLock;
            Mail::to($email)->send($mailer);

            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt(['email'=>$email, 'password'=>$password])) {
            return redirect('/');
        }

        if (!$throttles) {
            $this->incrementLoginAttempts($request);
        }

        return view('user.login', ['message'=>'ログインに失敗しました。']);
    }


    // ================================================
        // Illuminate\Foundation\Auth\ThrottlesLogins をオーバライド
    // ================================================
    protected function throttleKey(Request $request)
    {
        $email = $request->email;
        if (!empty($request->email)) {
            $email = Str::lower($request->email);
        }
        return $email.'|'.$request->ip();
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
       return $this->limiter()->tooManyAttempts(
           $this->throttleKey($request), $this->maxLoginAttempts
       );
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $time = $seconds.'秒';

        //単位調整
        if ($seconds > 60) {
            $minites =  substr(gmdate("i", $seconds), -1) ;
            if ($seconds>=600) {
                $minites = gmdate("i", $seconds) ;
            }
            $time = $minites.'分';
        }

        throw ValidationException::withMessages([
            $request->email =>[trans('認証に失敗しました。'.$time.'以上開けて再度お試しください')],
        ])->status(429);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), $this->lockoutTime
        );
    }

    public function getLogout(){
        Auth::logout();//ログアウト

        return redirect('/');
    }


    // ================================================
        //  その他ファンクション
    // ================================================

    public function uploadImg(){
        info('uploadImg');
    }





}

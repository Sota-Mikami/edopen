<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
        return view('user.register');
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

        // TODO: 取得メールアドレスにメールを送信

        //Modelに反映
        $user = new User;
        $user->name = $localpart;
        $user->email = $request->email;
        //ハッシュ化し、DBに反映
        $user->password = Hash::make($request->password);



        $user->save();

        info('user : '.$user);

        return view('user.register');
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
    // public function edit($id)
    public function edit()
    {
        //（疑問）User_idを取得する場合は、『編集フォーム』から取得した方が良いのか、それとも、ログインユーザーのIDをそのまま取得した方がいいのか。
        // info('ID : '.Auth::user()->id);
        $user = User::find(Auth::user()->id);
        // info('ユーザー情報 : '.$user);

        return view('user.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //分からない点：下記にUserRequestを使用した場合に、updateメソッドの処理が実行されない
    public function update(Request $request)
    {

        // info('ファイル名'.$request->file('profile_img')->getClientOriginalName());
        // info('function update'.$request);
        //フォームから画像を取得し、 "/storage/app/public/profile_img"に保存
        //フォームから画像を取得し、
        // $path = $request->file('profile_img')->store('profile_images','public');
        // info($path);

        // 認証済みのユーザーのみ、ユーザー情報をログインできるようにする
        $user = User::find(Auth::user()->id);
        // info($user);
        info($request->all());

        $form = $request->all();
        unset($form['_token'],$form['profile_img']);
        $user->fill($form);
        if (!empty($request->profile_img)) {
            $user->img = $request->file('profile_img')->store('profile_images','public');
        }

        $user->save();

        info($user);
        // GET
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
            return redirect('index');
        }

        return view('users.login', ['message'=>'ログインに失敗しました。']);
    }

    public function getLogout(){
        Auth::logout();//ログアウト

        return redirect('users/login');
    }


    // ================================================
        //  その他ファンクション
    // ================================================

    public function uploadImg(){
        info('uploadImg');
    }













}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $user->password = Hash::make($request->password);
        $user->save();

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
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
    //分からない点：下記にUserRequestを使用した場合に、updateメソッドの処理が実行されない
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

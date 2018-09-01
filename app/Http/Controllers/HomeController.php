<?php

namespace App\Http\Controllers;


use App\User;
use App\Content;
use App\ContentImg;
use Illuminate\Http\Request;
// use App\Http\Requests\UserRequest;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ユーザー情報を取得
        $user = Auth::user();
        info($user);

        $contents = Content::all();
        info($contents);

        return view('index',['user'=>$user,'contents'=>$contents]);
    }
}

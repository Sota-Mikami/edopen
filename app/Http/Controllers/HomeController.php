<?php

namespace App\Http\Controllers;


use App\User;
use App\Content;
use App\ContentImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User;
        $paid_contents = [];
        //ユーザー情報を取得
        if (Auth::check()) {
            // $user = Auth::user();
            $user = User::find(Auth::user()->id);
        }
        // dd($user->paid_content[0]->pivot->paid_user_id);

        // $paid_content = new Content;
        // $test = $paid_content->paid_user(16);
        // dd($test);

        //購入済みコンテンツ一覧
        foreach ($user->paid_content as $value) {
            $paid_contents[] = Content::find($value->pivot->content_id);
        }
        // Log::debug($paid_contents[0]);

        //コンテンツ一覧
        $contents = Content::all();

        return view('index',[
                            'user'=>$user,
                            'contents'=>$contents,
                            'paid_contents'=>$paid_contents,
                        ]);
    }



}

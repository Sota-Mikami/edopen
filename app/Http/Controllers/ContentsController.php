<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContentRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Content;
use App\ContentImg;


class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $sample = "sample";
        // Log::debug($sample);
        return view('content.create');
    }

    public function confirm(ContentRequest $request){

        Log::debug($request->file('files'));



        $i = 0 ;
        foreach ($request->file('files') as $index => $e) {
            $ext = $e['img'];
            Log::debug($index);
            Log::debug($ext);

            //ファイルを一時保存ディレクトリへ保存
            $files[$i] = $ext->store('content_images/temp','public');
            Log::debug($files);
            $i++;
        }

        $contents_info = [
            'title' => $request->title,
            'detail'=>$request->detail,
            'price' =>$request->price,
            'images'=>$files,
        ];

        $request->session()->put('content',$contents_info);
        $test = session()->get('content');
        Log::debug($test);
        Log::debug("==========================");

        $data_all = session()->all();
        Log::debug($data_all);

        return view('content.confirm');

        // $test = $request->file('file')->guessExtension();
        // $thum_name = uniqid("THUM_") . "." . $request->file('img1')->guessExtension();
        // Log::debug($test);

        // TMPファイル名
        // $request->file('thum')->move(storage_path() . "/img/tmp", $thum_name);
        // $thum = "/img/tmp/".$thum_name;
        //
        // $hash = array(
        // 'thum' => $thum,
        // 'username' => $username,
        // );
        //
        // return view('uploader.confirm')->with($hash);




        // Log::debug($request->all());
        // $content = $request->all();
        // $test = $request->file('img1')->store('content_images','public');
        // Log::debug($test);



        // 実際のstoreメソッドでは、配列の内容（要素の数）に応じて、
        // それぞれのカラム（img1,img2,img3,img4）に値をセットし、保存する

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
        $params =[];

        $user_id = Auth::user()->id; //ログインユーザー取得

        $content_info = new Content;
        $content_info->title = $request->title;
        $content_info->detail = $request->detail;
        $content_info->price = $request->price;
        $content_info->user_id = $user_id;
        $content_info->save();


        // 該当するimgカラムにそれぞれセット
        foreach($request->images as $index => $img){
            $index++;
            $column = 'img'.$index;
            $params[$column] =$img['img'];
        }

        $content_info->content_imgs()->create($params);

        Log::debug($params);

        //確認画面時に一時保存したファイルを
        //ユーザー別ディレクトリへ移動



        Log::debug("==========================");
        Log::debug("store : ");
        Log::debug($request);



        // return redirect('/contents/create');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use App\User;
use App\Content;
use App\ContentImg;


class ContentsController extends Controller
{
    /**
     *
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
        return view('content.create');
    }


    public function confirm()
    {
        return view('content.confirm');
    }


    public function postConfirm(ContentRequest $request){

        $files=[];//教材イメージ用の配列
        $teaching_material = '';//教材コンテンツ

        if (!empty($request->file()['file'])) {
            $i = 0 ;
            foreach ($request->file('file') as $img) {
                //ファイルを一時保存ディレクトリへ保存
                $files[$i] = $img->store('content_images/temp','public');
                $i++;
            }
        }

        if (!empty($request->file()['teaching_material'])) {
            $teaching_material = $request->file('teaching_material')->store('teaching_materials/temp','public');
        }


        $contents_info = [
            'title' => $request['title'],
            'detail'=>$request['detail'],
            'price' =>$request['price'],
            'images'=>$files,
            'teaching_material'=>$teaching_material,
        ];

        $request->session()->put('content',$contents_info);//セッションに保存

        return view('content.confirm');
    }



    public function getImage(Content $content){
        return view('content.confirm',compact('content'));
    }


    // コンテンツ投稿確認画面において、
    // キャンセルした場合に一時保存フォルダ（temp）から投稿するファイルを削除する
    public function cancel(){
        if (session()->exists('content')) {
            // セッションから画像データを取得
            $content = session()->get('content');

            // アップロードされたコンテンツ画像の数だけ、指定のファイルを削除
            foreach ($content['images'] as $value) {
                File::Delete(storage_path() . "/app/public/".$value);
            }
            //教材コンテンツを一時保存フォルダから削除
            File::Delete(storage_path() . "/app/public/".$content['teaching_material']);
        }
        return redirect('/contents/create')->withInput($content);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(ContentRequest $request)
    public function store(Request $request)
    {
        session()->forget('content');

        $params =[];
        $teaching_material_name  = '';
        $user_id = Auth::user()->id; //ログインユーザー取得

        if (!empty($request['images'])) {
            foreach($request['images'] as $img){
                //ファイル名を取得する
                $file_names[] = str_replace('content_images/temp/','',$img['img']);
            }
        }

        if (!empty($request->teaching_material)) {
            //教材コンテンツファイル名取得
            $teaching_material_name = str_replace('teaching_materials/temp/','',$request->teaching_material);

        }

        $content = new Content;
        $content->title = $request['title'];
        $content->detail = $request['detail'];
        $content->price = $request['price'];
        $content->user_id = $user_id;
        $content->teaching_material = $teaching_material_name;
        $content->save();
        $cotent_id = $content->id;

        $contentImg = [];
        if (!empty($request->images)) {
            foreach ($file_names as $index => $file_name) {
                $index++;
                $contentImg[]= new ContentImg([
                                        'img'=>$file_name,
                                        'order' =>$index,
                                    ]);
                //一時保存ディレクトリから本番用ディレクトリへファイル移動
                $this->moveFile('content_images',$cotent_id, $file_name);
            }
        }

        $content->content_imgs()->saveMany($contentImg);

        //一時保存ディレクトリから本番用ディレクトリへファイル移動
        if (!empty($request->teaching_material)) {
            $this->moveFile('teaching_materials',$cotent_id, $teaching_material_name);
        }

        return view('content.complete');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request )
    {
        $content = Content::find($request->id);
        $content_imgs = Content::find($request->id)->content_imgs;

        return view('content.show',['content'=>$content,'content_imgs'=>$content_imgs]);
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



    // 教材コンテンツダウンロードメソッド
    public function download(Request $request){
        // コンテンツのIDを取得
        $content_id = Content::find($request->id)->id;

        $file_path = storage_path()."/app/public/teaching_materials/" . $content_id.'/'. $request->file_name;

        return response()->download($file_path);
        return redirect('/content/show?id='.$request->id);
    }



    // ファイルアップロードメソッド
    public function moveFile($directory, $cotent_id, $file_name)
    {
        // //本番ディレクトリが存在しない場合に、ユーザー専用のディレクトリを作成
        if (!file_exists(storage_path() . "/app/public/".$directory."/" . $cotent_id)) {
            mkdir(storage_path() . "/app/public/".$directory."/" . $cotent_id, 0777);
        }
        // // 一時保存から本番の格納場所へ移動
        rename(storage_path() . "/app/public/".$directory."/temp/".$file_name , storage_path() . "/app/public//".$directory."/" . $cotent_id .'/'.$file_name );
    }

}

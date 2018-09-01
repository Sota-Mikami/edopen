<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
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
        return view('content.create');
    }

    public function confirm(ContentRequest $request){

        $files=[];
        $teaching_material = '';

        // if (!empty($request->file('files'))) {
            $i = 0 ;
            foreach ($request->file('files') as $index => $e) {
                $ext = $e['img'];
                Log::debug($ext);

                //ファイルを一時保存ディレクトリへ保存
                $files[$i] = $ext->store('content_images/temp','public');
                Log::debug($files);
                $i++;
            }
            Log::debug('teaching_material');
            Log::debug($request->file('teaching_material'));

            $teaching_material = $request->file('teaching_material')->store('teaching_materials/temp','public');

        // }


        $contents_info = [
            'title' => $request->title,
            'detail'=>$request->detail,
            'price' =>$request->price,
            'images'=>$files,
            'teaching_material'=>$teaching_material,
        ];
        Log::debug($contents_info);



        $request->session()->put('content',$contents_info);
        $test = session()->get('content');

        Log::debug("==========================");
        $data_all = session()->all();
        Log::debug($data_all);


        return view('content.confirm');

    }

    // コンテンツ投稿確認画面において、キャンセルした場合に一時保存フォルダ（temp）から投稿するファイルを削除する
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
    public function store(ContentRequest $request)
    {
        $params =[];
        $teaching_material_name  = '';
        $user_id = Auth::user()->id; //ログインユーザー取得


        // if (!empty($request->file('files'))) {
            // content_imgsテーブルの該当するimgカラムにそれぞれセット
            // （最大4つまで画像保存可  : img1 ~ img4）
            foreach($request->images as $index => $img){
                $index++;
                $column = 'img'.$index;//カラム名
                //ファイル名を取得する
                $file_name = str_replace('content_images/temp/','',$img['img']);
                $params[$column] =$file_name;

                //確認画面時に一時保存したファイルをユーザー別ディレクトリへ移動
                // TODO: user_idでディレクトリ区切っている部分をcontents_idで区切るべき
                if (!file_exists(storage_path() . "/app/public/content_images/" . $user_id)) {
                    mkdir(storage_path() . "/app/public/content_images/" . $user_id, 0777);
                }

                // // 一時保存から本番の格納場所へ移動
                rename(storage_path() . "/app/public/content_images/temp/".$file_name , storage_path() . "/app/public/content_images/" . $user_id .'/'.$file_name );
            }

            //教材コンテンツのファイル名を取得する
            $teaching_material_name = str_replace('teaching_materials/temp/','',$request->teaching_material);

            if (!file_exists(storage_path() . "/app/public/teaching_materials/" . $user_id)) {
                mkdir(storage_path() . "/app/public/teaching_materials/" . $user_id, 0777);
            }

            // // 一時保存から本番の格納場所へ移動
            rename(storage_path() . "/app/public/teaching_materials/temp/".$teaching_material_name , storage_path() . "/app/public/teaching_materials/" . $user_id .'/'.$teaching_material_name );

            Log::debug($teaching_material_name);

        // }



        $content_info = new Content;
        $content_info->title = $request->title;
        $content_info->detail = $request->detail;
        $content_info->price = $request->price;
        $content_info->user_id = $user_id;
        $content_info->teaching_material = $teaching_material_name;
        $content_info->save();

        //contentテーブルに関連するcontent_imgsテーブルにimgカラムをインサート
        $content_info->content_imgs()->create($params);

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
        // dd($content_imgs->img1);


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


    public function download(Request $request){
        $user_id = Auth::user()->id; //ログインユーザー取得

        // dd($request->file_name);
        $file_path = storage_path()."/app/public/teaching_materials/" . $user_id.'/'. $request->file_name;

        // dd($file_path);

        return response()->download($file_path);

        return redirect('/content/show?id='.$request->id);
    }






}

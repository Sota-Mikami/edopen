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
    // public $user

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
        $content = [];
        if (session()->exists('content')) {
            $content = session()->get('content');
        }

        return view('content.confirm',['content'=>$content]);
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
        $content = session()->get('content');

        return view('content.confirm',['content'=>$content]);
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
        $user_id = 0;
        $content = Content::find($request->id);
        $content_imgs = Content::find($request->id)->content_imgs;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

        return view('content.show',[
            'login_id'=>$user_id,
            'content'=>$content,
            'content_imgs'=>$content_imgs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $content = Content::find($request->id);
        $content_imgs = Content::find($request->id)->content_imgs;

        return view('content.edit',[
            'content'=>$content,
            'content_imgs'=>$content_imgs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request)
    {
        $insert_content_img = [];
        $input_date= $request->all();

        $content = Content::find($request->id);
        $content_imgs = Content::find($request->id)->content_imgs->all();

        for ($i=0; $i <=3 ; $i++) {
            if (!empty($request->file[$i])) {
                $input_file = $request->file()['file'][$i]->store('content_images/'.$content->id ,'public');
                $file_name = str_replace('content_images/'.$content->id. '/' ,'' ,$input_file);

                if (!empty($content_imgs[$i]->img)) {
                    //元ファイル削除
                    File::Delete(storage_path()."/app/public/content_images/".$content->id."/".$content_imgs[$i]->img);

                    $content_imgs[$i]->img = $file_name;//ファイル名
                    $content_imgs[$i]->order = $i+1;//sort順
                    $content_imgs[$i]->save();

                }else {
                    //データベースに存在していなかった場合
                    //新しくインサートする
                    $insert_content_img[] = new ContentImg([
                                                    'img' =>$file_name,
                                                    'order'=>$i+1,
                                                ]);
                }
            }
        }
        if (isset($insert_content_img)) {
            $content->content_imgs()->saveMany($insert_content_img);
        }

        //SORTの並び替え処理（asc）
        $order_change_imgs = Content::find($request->id)->content_imgs->all();
        foreach ($order_change_imgs as $index => $img) {
            $order_change_imgs[$index]->order = $index+1;
            $order_change_imgs[$index]->save();
        }



        //教材コンテンツ処理
        if (!empty($request->file()['teaching_material'])) {
            //元ファイル削除
            File::Delete(storage_path()."/app/public/teaching_materials/".$content->id."/".$content->teaching_material);
            //新しいコンテンツをアップロード
            $teaching_material_name = $request->file('teaching_material')->store( 'teaching_materials/'.$content->id, 'public');
            //ファイル名を抽出
            $teaching_material = str_replace('teaching_materials/'.$content->id. '/' ,'' ,$teaching_material_name);
            Log::debug($teaching_material);
        }



        $content->title = $input_date['title'];
        $content->detail = $input_date['detail'];
        $content->price = $input_date['price'];
        $content->teaching_material = $teaching_material;
        $content->save();

        return redirect('/content/edit?id='.$content->id);

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



    public function delete_contents_img(Request $request)
    {
        $content_img = ContentImg::where('img',$request->img)->first();
        $content = Content::find($content_img->content_id);


        File::Delete(storage_path()."/app/public/content_images/".$content->id."/".$content_img->img);
        $content_img->delete();
        $content->sortAsc();

        return redirect('/content/edit?id='.$content->id);
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

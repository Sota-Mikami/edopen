<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Content;
use App\User;
use App\Category;

class Search extends Model{

    //やりたいこと
    //・ それに該当しない限り、データを取得する
    //   └ データを分割し取得（例：15件ずつ取得など）
    //・検索結果が重複しないように、データを取り出したい
    //   └ フォームに"test te "のようにスペース区切りで類似キーワードを検索すると出力データに重複データが出るため
    //・array_unique関数で重複削除すると、pagenationをするのが難しい
    //・
    //課題
    //・現在のやり方では、ページネーションのようにデータを分割しつつ、重複したデータを抽出できない




    public function search($q){
        $search_contents_id = [];//キーワードに該当するcontentのidを取得
        $selector = [];//取得したいカラム
        $results=[]; //出力する検索結果

        //1. キーワードを分割
        $keywords = $this->separateKeyword($q);
        //2. キーワード毎にデータベースへアクセス
        $selector = [
            'content.id as content_id',
        ];
        foreach ($keywords as $keyword) {
            $search_contents_id = array_merge($search_contents_id,$this->makeBaseQuery($keyword,$selector));
        }

        dd($search_contents_id);
        //3.検索後、重複しているコンテンツを省く
        //content_idの重複チェック
        $contents_id = $this->checkDuplicate($search_contents_id);
        dd($contents_id);

        foreach ($contents_id as  $content_id) {
            $results[] = $this->searchContentData($content_id);
        }
        dd($results);

        return $results;
    }



    // ==================================================
    //     【テスト】DBクエリビルダ
    // ==================================================

    public function searchContentData($content_id){
        $selector = [
            'content.id as content_id',
             'content.title as content_name',
             'users.name as producer',
             'content.detail as content_detail',
              'categories.name as category_name'
        ];

        $results = DB::table('users')
                        ->leftJoin('content','content.user_id','=','users.id')
                        ->leftJoin('content_categories','content.id','=','content_categories.content_id')
                        ->leftJoin('categories','content_categories.category_id','=','categories.id')
                        ->select($selector)
                        ->where('content.id','LIKE',$content_id)
                        ->first()
                        ;

        return $results;
    }


    //キーワード検索メソッド
    //検索対象のテーブルを作成
    public function makeBaseQuery($word,$selector){

        $results = DB::table('users')
                        ->leftJoin('content','content.user_id','=','users.id')
                        ->leftJoin('content_categories','content.id','=','content_categories.content_id')
                        ->leftJoin('categories','content_categories.category_id','=','categories.id')
                        ->select($selector)
                        ->where('content.title','LIKE',"%$word%")
                        ->orWhere('users.name','LIKE',"%$word%")
                        ->orWhere('content.detail','LIKE',"%$word%")
                        ->orWhere('categories.name','LIKE',"%$word%")
                        // ->get()
                        ->paginate(2)
                        ->toarray()
                        ;
                        // dd($results);
        return $results;
    }


    //【複数キーワードの場合】 キーワード分割メソッド
    public function separateKeyword($q){

        //全角スペースを半角スペースへ変換
        $keyword = mb_convert_kana($q, 's', 'utf-8');
        //正規表現（空白）をキーに、配列へ格納
        $array_keyword = preg_split('/[\s]+/',$keyword,-1,PREG_SPLIT_NO_EMPTY);

        return $array_keyword;
    }

    //検索結果後のデータ重複チェック
    //例：検索フォームに同じキーワードがスペースで続けて検索された場合など
    public function checkDuplicate($target){
        //重複データを取得

        foreach ($target as $v) {
            $target_content_id[] = $v->content_id;
        }

        $duplicate_data = array_unique($target_content_id);

        return $duplicate_data;

    }


}

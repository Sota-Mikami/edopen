<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Content extends Model
{
    protected $table = 'content';
    protected $primaryKey = 'id';


    public function getID(){
        return $this->id;
    }

    //コンテンツ画像のSORT処理
    public function sortAsc(){
        //SORTの並び替え処理（asc）
        $order_change_imgs = Content::find($this->id)
                                        ->content_imgs()
                                        ->orderBy('order','asc')
                                        ->get();

        foreach ($order_change_imgs as $index => $img) {
            Log::debug($order_change_imgs[$index]->order);
            $order_change_imgs[$index]->order = $index+1;
            $order_change_imgs[$index]->save();
        }
    }

    //ログインユーザーのコンテンツ購入済チェック
    public function checkPaid($login_id){
        $result = false;
        $paid_user = $this->paid_user->where('id',$login_id)->first();

        if (!is_null($paid_user)) {
            $result = true;
        }
        return $result;
    }

    //購入済みの教材コンテンツのダウンロード
    public function getTeachingMaterialPath(){
        $file_path = storage_path()."/app/public/teaching_materials/" . $this->id.'/'. $this->teaching_material;

        // Log::debug($this->teaching_material);
        // dd($file_path);

        return $file_path;
    }



// =================================
//                               リレーション
// =================================
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function content_imgs(){
        return $this->hasMany('App\ContentImg');
    }

    //【リレーション】購入されたユーザー
    public function paid_user(){
        return $this->belongsToMany('App\User', 'paid_user_content', 'content_id', 'paid_user_id')->withTimestamps()->withPivot('paid_user_id','content_id');
    }


}

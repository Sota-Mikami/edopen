<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Content extends Model
{
    protected $table = 'content';
    protected $primaryKey = 'id';

    public function filename(){
        $ext  = 'jpg';

        switch($this->mime){
            case 'image/jpeg':
            case 'image/jpg':
                $ext = 'jpg';
                break;
            case 'image/png' :
                $ext = 'png';
                break;
            case 'image/gif' :
                $ext = 'gif';
                break;
        }

        return sprintf("%d.%s", md5($this->id), $ext );

    }

    public function getID(){
        return $this->id;
    }

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


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function content_imgs(){
        return $this->hasMany('App\ContentImg');
    }

    //【リレーション】購入されたユーザー
    public function paid_user($id=null){
        // if (!empty($id)) {
        //     // dd($id);
        //     return $this->belongsToMany('App\User', 'paid_user_content', 'content_id', 'paid_user_content')->withTimestamps()->wherePivot('id', $id)->withPivot('paid_user_id','content_id');
        // }


        return $this->belongsToMany('App\User', 'paid_user_content', 'content_id', 'paid_user_content')->withTimestamps()->withPivot('paid_user_id','content_id');
    }


}

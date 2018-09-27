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
}

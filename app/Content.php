<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function content_imgs(){
        return $this->hasMany('App\ContentImg');
    }
}

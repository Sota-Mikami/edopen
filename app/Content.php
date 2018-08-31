<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function content_imgs(){
        return $this->hasOne('App\ContentImg');
    }
}

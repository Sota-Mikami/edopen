<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentImg extends Model
{
    protected $table = 'content_imgs' ;

    protected $fillable = [
        'img1', 'img2', 'img3','img4', 'order',
    ];

    public function content(){
        return $this->belongsTo('App\Content');
    }
}

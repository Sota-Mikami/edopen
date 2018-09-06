<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentImg extends Model
{
    protected $table = 'content_imgs' ;
    protected $primaryKey = 'id';


    protected $fillable = [
        'content_id','mime',
    ];

    protected $baseUri = '';

    public function storeImage($file){
        $file->move(public_path('content_images'),$this->filename());
    }

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





    public function content(){
        return $this->belongsTo('App\Content');
    }
}

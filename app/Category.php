<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';






    // =================================
    //                               リレーション
    // =================================
    //本カテゴリーに所属するコンテンツ
    public function contents(){
        return $this->belongsToMany('App\Content',
        'content_categories','category_id',
        'content_id')->withTimestamps()->withPivot('content_id','category_id');
    }



}

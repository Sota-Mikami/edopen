<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','img', 'bio','email_verified','email_verify_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//フォローチェック
public function checkFollow(){
    $result = false;
    $user = User::find(Auth::user()->id);
    $target_user = $user->relationships()->where('follower_id',$this->id)->first();
    // dd($target_user);
    if (!empty($target_user)) {
        $result = true;
    }

    return $result;

}






// ============================================
            //     リレーション
// ============================================
    public function contents(){
        return $this->hasMany('App\Content');
    }

    public function facebook(){
        return $this->hasOne('App\Auth\Facebook');
    }

    //【リレーション】購入済のコンテンツ
    public function paid_content(){
        return $this->belongsToMany('App\Content' , 'paid_user_content', 'paid_user_id', 'content_id')->withTimestamps()->withPivot('paid_user_id','content_id');
    }

    //【リレーション】フォロー（followed , following）
    public function relationships(){
        return $this->belongsToMany('App\User', 'relationships',
        'followed_id', 'follower_id')->withTimestamps()->withPivot('followed_id','follower_id');
    }





}

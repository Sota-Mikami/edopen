<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if (!empty($target_user)) {
            $result = true;
        }
        return $result;
    }

    //リレーションユーザー一覧取得（followed or following）
    public function getRelationUser($status){
        $relation_info = [
                'users'=>[],
                'status'=>'',
        ];

        if ($status == 'following') {
            // $relation_user = $this->getFollowingUser();
            $relation_info['users']=$this->getFollowingUser();
            $relation_info['status']= 'フォロー一覧';
        }else{
            // $relation_user = $this->getFollowedUser();
            $relation_info['users']=$this->getFollowedUser();
            $relation_info['status']= 'フォロワー一覧';
        }
        return $relation_info;
        // return $relation_user;
    }

    //ログインユーザーのフォローユーザー数カウント
    public function getCoungFollowingUser(){
        $amount_following_users = count($this->getFollowingUser());

        return $amount_following_users;
    }

    //ログインユーザーのフォローユーザー数カウント
    public function getCoungFollowedUser(){
        $amount_followed_users = count($this->getFollowedUser());

        return $amount_followed_users;
    }


    // フォローユーザー取得
    public function getFollowingUser(){
        $login_user = User::find(Auth::user()->id);
        $following_users = $login_user->relationships;

        return $following_users;
    }

    // フォロワーユーザー取得
    public function getFollowedUser(){
        $login_user = User::find(Auth::user()->id);
        $followed_users = DB::table('relationships')
                                ->join('users','relationships.follower_id','=','users.id')
                                ->where('relationships.follower_id',$login_user->id)->get();
        return $followed_users;
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

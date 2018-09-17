<?php

namespace App\Auth;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    protected $table = 'facebook';
    protected $primaryKey = 'id';

    protected $fillable = [
        'facebook_id', 'facebook_name', 'avatar','user_id',
    ];

    public function user(){
        return belongsTo('App\User');
    }
}

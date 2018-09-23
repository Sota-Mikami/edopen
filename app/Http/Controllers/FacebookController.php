<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Auth\Facebook;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

class FacebookController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback(){
        try {
            $providerUser = Socialite::driver('facebook')->user();
            $user = User::where('email',$providerUser->getEmail())->first();


            if (is_null($user)) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                ]);
            }

            if (is_null($user->facebook()->first())) {
                $facebook = new Facebook([
                    'facebook_id'=>$providerUser->getId(),
                    'facebook_name' => $providerUser->getName(),
                    'avatar'=>$providerUser->avatar_original,
                    'user_id'=>$user->id,
                ]);

                $user->facebook()->save($facebook);
                $user->save();
            }

            auth()->login($user, true);
            return redirect()->to('/');

        } catch (\Exception $e) {
            dd($e);
            return redirect('/');
        }

    }
}

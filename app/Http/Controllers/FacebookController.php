<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback($provider){
        try {
            $providerUser = Socialite::driver($provider)->user();

            $user = DB::table('users')->where('email', $providerUser->getEmail())->first();

            if (is_null($user)) {

                if (is_null($providerUser->getNickname())) {
                    $providerUserNickName = $providerUser->getName();
                }else {
                    $providerUserNickName = $providerUser->getNickName();
                }

                $userd = User::create([
                    'name' => $providerUserNickName,
                    'email' => $providerUser->getEmail(),
                ]);


            }else {
                $userd = User::find( $user->id);
            }

            if (is_null($userd->facebook_id)) {
                $user->facebook_id = $providerUser->getId();

                if (is_null($providerUser->getNickname()) ) {
                    $userd->facebook_name = $providerUser->getName();
                }else {
                    $userd->facebook_name = $providerUser->getNickname();
                }
            }

            $userd->save();

            auth()->login($userd, true);
            return redirect()->to('/');

        } catch (\Exception $e) {
            return redirect('/');
        }

    }
}

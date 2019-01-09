<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Socialite;
use App\User;
use Auth;
class SocialLoginController extends Controller
{
    //
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }
 
   /**
    * Obtain the user information from Social Logged in.
    * @param $social
    * @return Response
    */
   public function handleProviderCallback($social)
   {
        $user = Socialite::driver($social)->user();
        // $authUser = $this->findOrCreateUser($user, $provider);
        $authUser = User::where('provider_id', $user->id)->first();
        if (!empty($authUser)) {
            $loginUser = $authUser;
        } else {
            //print_r($user);die;
            $loginUser = new User();
            $loginUser->name = $user->name;
            $loginUser->email = $user->email;
            $loginUser->provider_id = $user->id;
            $loginUser->save();
            //  User::create([
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'provider_id' => (string)$user->id
            // ]);
        }
 
        Auth::login($loginUser, true);
 
        return redirect('/');
   }
}

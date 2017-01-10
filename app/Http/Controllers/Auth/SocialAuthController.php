<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handle($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        $user = User::whereEmail($providerUser->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'password' => uniqid(rand(), true),
                'avatar' => $providerUser->getAvatar(),
            ]);
        }

        auth()->login($user);

        return redirect()->action('Web\HomeController@index');
    }
}

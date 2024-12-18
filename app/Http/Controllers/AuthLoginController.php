<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Laravel\Socialite\Facades\Socialite;


class AuthLoginController extends Controller
{
    public function redirectToProvider(Request $request, $provider)
    {
        if($request->session()->has('mobile')){
            $request->session()->forget('mobile');
        }

        if($request->has('mobile'))
            $request->session()->put('mobile', 'true');
        
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $loggedUser = User::firstOrCreate(
            ['email' => $user->email],
            [
                'name' => $user->name,
                'password' => Hash::make($user->token),
                'surname' => $user->name,
                'email_verified_at' => Carbon::now(),
                'country_id' => 1,
                'status' => 1,
                'user_role_id' => 2,
            ]
        );

        $token = $loggedUser->createToken('api token');
        // return $token;
        if($request->session()->has('mobile')){
            return Redirect::to('https://peqer-app.netlify.app/#/login' . '?token=' . $token->accessToken);
        } else {
            return Redirect::to('https://peqer.netlify.app/login' . '?token=' . $token->accessToken);
        }

    }
    
}

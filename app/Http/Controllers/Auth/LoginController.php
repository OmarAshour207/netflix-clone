<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        config([
            'services.'.$provider.'.client_id'        => setting(''.$provider.'.client_id'),
            'services.'.$provider.'.client_secret'    => setting(''.$provider.'.secret_id'),
            'services.'.$provider.'.redirect'         => setting(''.$provider.'.redirect_url')
        ]);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $social_user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        // add provider and provider_id in database
        $user = User::where('provider', $provider)
                ->where('provider_id', $social_user->getId())
                ->first();

        if (!$user){
            $user = User::create([
                'name'          => $social_user->getName(),
                'email'         => $social_user->getEmail(),
                'provider'      => $provider,
                'provider_id'   => $social_user->getId()
            ]);
            $user->attachRole('user');
        }

        // to make login
        Auth::login($user, true);

        // redirect to home page or the page he want to redirect
        return redirect()->intended('/');
    }
}

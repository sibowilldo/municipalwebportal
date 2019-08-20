<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\SocialAccountService;

class SocialLoginController extends Controller
{

    /**
     * @param $social
     * @return mixed
     */
    public function redirectToSocial($social)
    {
        return Socialite::with($social)->redirect();
    }

    /**
     * @param SocialAccountService $service
     * @param $social
     * @return \Exception|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function handleSocialCallback(SocialAccountService $service, $social)
    {
        try {
            $user = $service->setOrGetUser(Socialite::driver($social));
            if (!$user){
                abort(404, 'Oops! Something went wrong while trying to log you in. Please contact system administrator');
            }
            auth()->login($user);
            return redirect('/');
        } catch (\Exception $e) {
            return $e;
        }
    }
}

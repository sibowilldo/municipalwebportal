<?php
namespace App;
use Carbon\Carbon;
use Laravel\Socialite\Contracts\Provider;
class SocialAccountService
{
    public function setOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                            'firstname' => $providerUser->getName(),
                            'lastname' => $providerUser->getNickName(),
                            'contactnumber' => '',
                            'activation_token' => '', // ToDo set to str_random(60) later
                            'email_verified_at' => Carbon::now(),
                            'email' => $providerUser->getEmail(),
                            'password' => bcrypt($providerUser->getId()),
                            'status_is' => 'active' //ToDo set to inactive later
                        ]
                    );
                $user->assignRole(['user']);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
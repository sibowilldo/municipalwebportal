<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name' =>['required', 'string', 'max:255'],
            'last_name' =>['required', 'string', 'max:255'],
            'contact_number' =>['required', 'string', 'max:20', 'unique:profiles'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {

            $user = User::create([
                'activation_token' => Str::random(16),
                'email' => $input['email'],
                'password' => Hash::make($input['password'])
            ]);
//            $this->createProfile($user,$input);
            $this->createTeam($user);

            return $user;
//            (), function (User $user) use ($input) { });
        });
    }

    /**
     * Create a profile for the user.
     *
     * @param \App\Models\User $user
     * @param $input
     * @return void
     */
    protected function createProfile(User $user, $input)
    {
        $user->profile()->forceCreate([
            'first_name' =>$input['required'],
            'last_name' =>$input['required'],
            'contact_number' =>$input['required']
        ]);
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->profile->fullname, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}

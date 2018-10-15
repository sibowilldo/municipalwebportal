<?php

use Illuminate\Database\Seeder;
use App\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User([
            'firstname' => 'su',
            'lastname' => 'super-administrator',
            'contactnumber' => '0718988006',
            'activation_token' => '',
            'email' => 'sibongiseni.msomis@gmail.com',
            'password' => bcrypt(env('SU_PASSWORD')),
            'status_is' => 'active'
        ]);

        $user->save();
        $user->assignRole('super-administrator');
    }
}

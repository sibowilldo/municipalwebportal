<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $user = new User([
            'firstname' => 'Sibongiseni',
            'lastname' => 'Msomi',
            'contactnumber' => '0718988006',
            'activation_token' => '',
            'email' => 'msomis@gmail.com',
            'password' => bcrypt('admin123'),
            'status_is' => 'active'
        ]);


        $user->save();
        $user->assignRole('administrator');
    }
}

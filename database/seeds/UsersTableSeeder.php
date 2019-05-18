<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class, 50)->create()->each(function ($user) {
            $roles = Role::all(['name']);
            $user->assignRole($roles[random_int(0, 3)]->name);
        });
    }
}

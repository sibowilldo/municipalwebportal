<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class IncidentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('incidents')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        factory(App\Incident::class, 5)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

use App\StateColor;

use Carbon\Carbon;

class StateColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StateColor::create(['name' => 'Primary',
            'css_class' => 'primary',
            'css_color' => '#5867dd',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Success',
            'css_class' => 'success',
            'css_color' => '#34bfa3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Warning',
            'css_class' => 'warning',
            'css_color' => '#ffb822',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Danger',
            'css_class' => 'danger',
            'css_color' => '#f4516c',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Info',
            'css_class' => 'info',
            'css_color' => '#36a3f7',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Secondary',
            'css_class' => 'secondary',
            'css_color' => '#eaeaea',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Brand',
            'css_class' => 'brand',
            'css_color' => '#716aca',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Accent',
            'css_class' => 'accent',
            'css_color' => '#00c5dc',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Focus',
            'css_class' => 'focus',
            'css_color' => '#9816f4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Metal',
            'css_class' => 'metal',
            'css_color' => '#c4c5d6',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        StateColor::create(['name' => 'Light',
            'css_class' => 'light',
            'css_color' => '#fff',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

    }
}

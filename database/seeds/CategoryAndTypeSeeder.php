<?php

use Illuminate\Database\Seeder;

class CategoryAndTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 7 records of categories
        factory(App\Category::class, 7)->create()->each(function ($category) {
            $types = factory(App\Type::class, 1)->make();
            $category->types()->saveMany($types);
        });
    }
}

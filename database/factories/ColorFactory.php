<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker
                ->unique()->randomElement([
                'Primary', 'Secondary', 'Brand', 'Accent', 'Focus', 'Metal', 'Dark',
                'Success', 'Danger', 'Warning', 'Info']),
            'color' => $this->faker
                ->unique()->randomElement(['#5867dd', '#eaeaea', '#716aca', '#00c5dc', '#9816f4', '#c4c5d6', '#5555dd',
                '#34bfa3', '#f4516c', '#ffb822', '#36a3f7'])
        ];
    }
}

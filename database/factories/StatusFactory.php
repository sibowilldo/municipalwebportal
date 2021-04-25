<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Active', 'Assigned', 'Trashed', 'Unverified', 'In Progress',
                'Completed', 'Escalated', 'Assigned', 'Declined', 'Review', 'Cancelled', 'Duplicate'
            ]),
            'description' => $this->faker->realText(),
            'model_type' => $this->faker->randomElement(['App\User', 'App\Incident', 'App\Team']),
            'color_id' => Color::factory()
        ];
    }
}

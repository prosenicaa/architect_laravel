<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flat>
 */
class FlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'floor' => fake()->numberBetween(0, 20),
            'max_people' => fake()->numberBetween(1, 5),
            'balcony' => fake()->randomElement(['yes', 'no']),
            'price' => fake()->numberBetween(2000, 300000)
        ];
    }
}

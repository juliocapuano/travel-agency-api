<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          => fake()->streetName,
            'starting_date' => fake()->dateTimeBetween('-60 days'),
            'ending_date'   => fake()->dateTimeBetween('now', '30 days'),
            'price'         => fake()->randomFloat(3, 20, 500),
        ];
    }
}

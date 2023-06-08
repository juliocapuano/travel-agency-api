<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->streetName();

        return [
            'is_public'      => fake()->boolean(80),
            'name'           => $name,
            'description'    => fake()->text(300),
            'number_of_days' => random_int(3, 10),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->userName(),
            'created_at' => $this->faker->dateTimeBetween('-5 years'),
            'updated_at' => $this->faker->dateTimeBetween('-5 years')
        ];
    }
}

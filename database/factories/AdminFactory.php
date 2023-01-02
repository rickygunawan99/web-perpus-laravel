<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nip' => $this->faker->randomNumber(),
            'name' => "{$this->faker->firstName} {$this->faker->lastName}",
            'password' => "admin",
            'created_at' => $this->faker->dateTimeBetween('-5 years'),
            'updated_at' => $this->faker->dateTimeBetween('-5 years')
        ];
    }
}

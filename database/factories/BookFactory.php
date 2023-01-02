<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'total_page' => $this->faker->numberBetween(111, 4444),
            'category_id' => $this->faker->numberBetween(1, Category::all()->count()),
            'author_id' => $this->faker->numberBetween(1, Author::all()->count()),
            'publisher_id' => $this->faker->numberBetween(1, Publisher::all()->count()),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id' => $this->faker->randomNumber(1, Member::count()),
            'total_day' => $this->faker->numberBetween(1,5),
            'is_checkout' => 1,
            'is_approve' => $this->faker->randomElement([1,2,4,2,3,2,4,4,2,3,4]),
            'created_at' => $this->faker->dateTimeBetween('- 2 year')
        ];
    }
}

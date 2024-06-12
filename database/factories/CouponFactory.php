<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->slug,
            'max_use' => 10,
            'per_user' => 1,
            'discount' => $this->faker->numberBetween(10,90),
            'discount_type' => $this->faker->randomElement(['Amount', 'Percentage']),
//            'type' => $this->faker->randomElement(['Order', 'Product']),
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addWeeks(3)
        ];
    }
}

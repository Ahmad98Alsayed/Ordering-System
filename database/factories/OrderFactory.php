<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $total = $this->faker->randomFloat(0, 10, 100);
        $discount = $this->faker->randomFloat(0, 1, 10);

        return [
            'user_id' => User::all()->random()->id,
            'city' => $this->faker->city,
            'discount' => $discount,
            'total' => $total - ($total * $discount / 100),
            'note' => $this->faker->realText(100, 2),
            'order_num' => $this->faker->unique()->numberBetween(00000, 99999),
        ];
    }
}

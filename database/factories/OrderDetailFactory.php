<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price_single = $this->faker->randomFloat(2, 10, 100);
        $discount = $this->faker->randomFloat(2, 1, 10);
        $quantity = $this->faker->numberBetween(1, 10);
        $price_total = $quantity * $price_single;
        return [
            'order_id' => Order::all()->unique()->random()->id,
            'product_id' => Product::all()->unique()->random()->id,
            'price_single' => $price_single,
            'price_total' => $price_total - ($price_total * $discount / 100),
            'discount' => $discount,
            'note' => $this->faker->realText(10, 1),
            'quantity' => $quantity,
        ];
    }
}

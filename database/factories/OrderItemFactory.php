<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = \App\Models\OrderItem::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();

        $quantity = $this->faker->numberBetween(1, 5);

        return [
            'order_id' => null, // You will assign this when creating related order
            'product_id' => $product ? $product->id : 1,
            'quantity' => $quantity,
            'price' => $product ? $product->price : 10.00,
        ];
    }
}

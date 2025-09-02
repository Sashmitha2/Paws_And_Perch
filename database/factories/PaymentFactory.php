<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = \App\Models\Payment::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first();

        return [
            'order_id' => $order ? $order->id : null,
            'amount' => $order ? $order->total_amount : 0,
            'payment_method' => $this->faker->randomElement(['Card', 'Cash on Delivery']),
            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}

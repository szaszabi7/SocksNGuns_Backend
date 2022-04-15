<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "item_id" => Item::all()->random(),
            "quantity" => $this->faker->numberBetween(1, 10),
            "order_id" => Order::all()->random()
        ];
    }
}

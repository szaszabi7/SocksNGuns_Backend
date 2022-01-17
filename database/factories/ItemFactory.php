<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->words(3, true),
            "price" => $this->faker->numberBetween(500, 10000000),
            "quantity" => $this->faker->numberBetween(1, 30000),
            "availability" => 1,
            "category_id" => $this->faker->numberBetween(1, 2),
        ];
    }
}

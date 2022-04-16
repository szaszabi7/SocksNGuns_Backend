<?php

namespace Database\Factories;

use App\Models\Category;
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
            "description" => $this->faker->words(20, true),
            "price" => $this->faker->numberBetween(500, 10000000),
            "quantity" => $this->faker->numberBetween(1, 30000),
            "availability" => 1,
            "category_id" => Category::all()->random()
        ];
    }
}

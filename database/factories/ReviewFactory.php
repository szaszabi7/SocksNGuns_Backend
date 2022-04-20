<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::all()->random(),
            "item_id" => Item::all()->random(),
            "message" => $this->faker->text(),
            "star" => $this->faker->randomFloat(2, 1, 5),
            "recommend" => $this->faker->numberBetween(0,1)
        ];
    }
}

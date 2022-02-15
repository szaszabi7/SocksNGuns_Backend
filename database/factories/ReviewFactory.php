<?php

namespace Database\Factories;

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
            "user_id" => $this->faker->numberBetween(1,10),
            "item_id" => $this->faker->numberBetween(1,10),
            "message" => $this->faker->text(),
            "star" => $this->faker->randomFloat(2, 1, 5),
            "recommend" => $this->faker->numberBetween(0,1)
        ];
    }
}

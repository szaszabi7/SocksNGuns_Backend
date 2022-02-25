<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => $this->faker->numberBetween(1, 10),
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "birth_date" => $this->faker->date(),
            "phone_number" => $this->faker->e164PhoneNumber(),
            "post_code" => $this->faker->postcode(),
            "city" => $this->faker->city(),
            "street" => $this->faker->streetName(),
            "street_number" => $this->faker->buildingNumber(),
            "floor" => $this->faker->numberBetween(0, 10),
            "door" => $this->faker->numberBetween(1, 50),
        ];
    }
}

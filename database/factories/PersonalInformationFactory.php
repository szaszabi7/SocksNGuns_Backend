<?php

namespace Database\Factories;

use App\Models\User;
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
            "user_id" => User::all()->random(),
            "full_name" => $this->faker->name(),
            "phone_number" => $this->faker->e164PhoneNumber(),
            "post_code" => $this->faker->postcode(),
            "city" => $this->faker->city(),
            "address" => $this->faker->streetAddress()
        ];
    }
}

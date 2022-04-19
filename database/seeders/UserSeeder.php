<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\User::factory([
            "name" => "testadmin",
            "email" => "testadmin@example.com",
            "is_admin" => 1,
            "gun_authorized" => 1,
            "password" => bcrypt("TestPassword01")
        ])->create();
        \App\Models\User::factory([
            "name" => "testuser",
            "email" => "testuser@example.com",
            "password" => bcrypt("TestPassword01")
        ])->create();
    }
}

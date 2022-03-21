<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonalInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PersonalInformation::factory(10)->create();
    }
}

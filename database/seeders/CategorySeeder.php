<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory()->create([
            'name' => 'zokni',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'fegyver',
        ]);
    }
}

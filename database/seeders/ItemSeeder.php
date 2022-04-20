<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Item::factory([
            "name" => "Piros zokni",
            "description" => "Piros zokni",
            "price" => 1500,
            "quantity" => 11234,
            "availability" => 1,
            "category_id" => 1
        ])->create();
        \App\Models\Item::factory([
            "name" => "Kék zokni",
            "description" => "Kék zokni",
            "price" => 1500,
            "quantity" => 23465,
            "availability" => 1,
            "category_id" => 1
        ])->create();
        \App\Models\Item::factory([
            "name" => "Zöld zokni",
            "description" => "Zöld zokni",
            "price" => 1500,
            "quantity" => 9876,
            "availability" => 1,
            "category_id" => 1
        ])->create();
        \App\Models\Item::factory([
            "name" => "Ak-47",
            "description" => "Az AK–47, hivatalosan Avtomat Kalashnyikova egy gázüzemű, 7.62×39mm kaliberű gépkarabély, melyet Mihail Tyimofejevics Kalasnyikov kézifegyver-tervező tervezett, ezért gyakran Kalasnyikov-gépkarabélynak nevezik.",
            "price" => 516369,
            "quantity" => 100,
            "availability" => 1,
            "category_id" => 2
        ])->create();
        \App\Models\Item::factory([
            "name" => "Kar98k",
            "description" => "A Mauser Karabiner 98 Kurz (más nevén Kar98k, K98, K98k) a német hadsereg alapvető lövészfegyvere volt a második világháborúban.",
            "price" => 344222,
            "quantity" => 50,
            "availability" => 1,
            "category_id" => 2
        ])->create();
        \App\Models\Item::factory([
            "name" => "M1 Garand",
            "description" => "Az M1 puskát nagy számban alkalmazták az amerikai erők a második világháború alatt, a koreai háború alatt és kisebb számban a vietnámi háború alatt",
            "price" => 378833,
            "quantity" => 10,
            "availability" => 1,
            "category_id" => 2
        ])->create();
    }
}

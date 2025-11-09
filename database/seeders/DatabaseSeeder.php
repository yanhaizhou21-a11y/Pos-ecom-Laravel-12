<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Inventory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
        //Item::factory(10)->create();
        Inventory::factory(30)->create();
    }
}

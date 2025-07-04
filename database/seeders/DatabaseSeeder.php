<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Offer;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\Promotion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@test.dev'],
            [
                'name' => 'admin',
                'password' => bcrypt('iKi697hHbF2p5DE'),
            ]
        );
    }
}

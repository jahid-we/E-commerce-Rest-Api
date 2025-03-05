<?php

namespace Database\Seeders;

use App\Models\ProductWish;
use Illuminate\Database\Seeder;

class ProductWishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductWish::create([
            'product_id' => 1, // Assuming product with id 1 exists
            'user_id' => 1,    // Assuming user with id 1 exists
        ]);

        ProductWish::create([
            'product_id' => 2, // Assuming product with id 2 exists
            'user_id' => 2,    // Assuming user with id 2 exists
        ]);

    }
}

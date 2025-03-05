<?php

namespace Database\Seeders;

use App\Models\ProductCart;
use Illuminate\Database\Seeder;

class ProductCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCart::create([
            'user_id' => 1,  // Assuming user with id 1 exists
            'product_id' => 1, // Assuming product with id 1 exists
            'color' => 'Red',
            'size' => 'M',
            'qty' => '2',
            'price' => '120.00',
        ]);

        ProductCart::create([
            'user_id' => 2,  // Assuming user with id 2 exists
            'product_id' => 2, // Assuming product with id 2 exists
            'color' => 'Blue',
            'size' => 'L',
            'qty' => '1',
            'price' => '150.00',
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Product One',
            'short_des' => 'This is a short description for Product One.',
            'price' => '100.00',
            'discount' => true,
            'discount_price' => '90.00',
            'image' => 'images/product_one.jpg',
            'stock' => true,
            'star' => 4.5,
            'remark' => 'popular',
            'category_id' => 1, // Assuming category with id 1 exists
            'brand_id' => 1,    // Assuming brand with id 1 exists
        ]);

        Product::create([
            'title' => 'Product Two',
            'short_des' => 'This is a short description for Product Two.',
            'price' => '150.00',
            'discount' => false,
            'discount_price' => '150.00',
            'image' => 'images/product_two.jpg',
            'stock' => true,
            'star' => 4.0,
            'remark' => 'new',
            'category_id' => 2, // Assuming category with id 2 exists
            'brand_id' => 2,    // Assuming brand with id 2 exists
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDetail::create([
            'img1' => 'images/product1_img1.jpg',
            'img2' => 'images/product1_img2.jpg',
            'img3' => 'images/product1_img3.jpg',
            'img4' => 'images/product1_img4.jpg',
            'des' => 'Detailed description for product 1. This product is of high quality and has excellent features.',
            'color' => 'Red',
            'size' => 'M',
            'product_id' => 1,  // Assuming product with id 1 exists
        ]);

        ProductDetail::create([
            'img1' => 'images/product2_img1.jpg',
            'img2' => 'images/product2_img2.jpg',
            'img3' => 'images/product2_img3.jpg',
            'img4' => 'images/product2_img4.jpg',
            'des' => 'Description for product 2. This is a premium quality item made for daily use.',
            'color' => 'Blue',
            'size' => 'L',
            'product_id' => 2,  // Assuming product with id 2 exists
        ]);

    }
}

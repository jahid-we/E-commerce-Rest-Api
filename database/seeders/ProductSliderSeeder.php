<?php

namespace Database\Seeders;

use App\Models\ProductSlider;
use Illuminate\Database\Seeder;

class ProductSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSlider::create([
            'title' => 'Product One Slider',
            'short_des' => 'This is a great slider for product one, showcasing its top features.',
            'price' => '120.00',
            'image' => 'images/product_one_slider.jpg',
            'product_id' => 1, // Assuming product with id 1 exists
        ]);

        ProductSlider::create([
            'title' => 'Product Two Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '150.00',
            'image' => 'images/product_two_slider.jpg',
            'product_id' => 2, // Assuming product with id 2 exists
        ]);

    }
}

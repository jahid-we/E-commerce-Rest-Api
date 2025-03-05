<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductReview::create([
            'description' => 'Great product, really happy with it!',
            'rating' => '5',
            'customer_id' => 1, // Assuming a customer with id 1 exists
            'product_id' => 1,  // Assuming a product with id 1 exists
        ]);

    }
}

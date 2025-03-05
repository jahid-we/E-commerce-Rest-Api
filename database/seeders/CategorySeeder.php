<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'categoryName' => 'Electronics',
            'categoryImg' => 'electronics.jpg',
        ]);

        Category::create([
            'categoryName' => 'Fashion',
            'categoryImg' => 'fashion.jpg',
        ]);

        Category::create([
            'categoryName' => 'Home & Kitchen',
            'categoryImg' => 'home_kitchen.jpg',
        ]);
    }
}

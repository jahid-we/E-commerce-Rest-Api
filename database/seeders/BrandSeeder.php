<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'brandName' => 'Brand One',
            'brandImg' => 'images/brand_one.jpg',
        ]);

        Brand::create([
            'brandName' => 'Brand Two',
            'brandImg' => 'images/brand_two.jpg',
        ]);
    }
}

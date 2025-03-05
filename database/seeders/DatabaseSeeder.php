<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            CustomerProfileSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductReviewSeeder::class,
            ProductDetailSeeder::class,
            ProductSliderSeeder::class,
            ProductWishSeeder::class,
            ProductCartSeeder::class,
            InvoiceSeeder::class,
            InvoiceProductSeeder::class,
            PolicySeeder::class,
            SslcommerzAccountSeeder::class,
        ]);

    }
}

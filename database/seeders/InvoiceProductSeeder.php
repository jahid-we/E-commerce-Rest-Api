<?php

namespace Database\Seeders;

use App\Models\InvoiceProduct;
use Illuminate\Database\Seeder;

class InvoiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceProduct::create([
            'invoice_id' => 1, // Assuming invoice with id 1 exists
            'product_id' => 1, // Assuming product with id 1 exists
            'user_id' => 1, // Assuming user with id 1 exists
            'qty' => '2',
            'sale_price' => '120.00',
        ]);

        InvoiceProduct::create([
            'invoice_id' => 2, // Assuming invoice with id 2 exists
            'product_id' => 2, // Assuming product with id 2 exists
            'user_id' => 2, // Assuming user with id 2 exists
            'qty' => '1',
            'sale_price' => '150.00',
        ]);

    }
}

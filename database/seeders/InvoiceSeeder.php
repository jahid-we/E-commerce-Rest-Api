<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'total' => '500.00',
            'vat_percentage' => '5%',
            'vat_amount' => '25.00',
            'payable' => '525.00',
            'cus_details' => 'John Doe, 123 Main St, Cityville, Country',
            'ship_details' => 'Jane Doe, 456 Oak Rd, Townsville, Country',
            'tran_id' => 'TRX123456',
            'val_id' => 'VAL123',
            'delivery_status' => 'Pending',
            'payment_status' => 'Unpaid',
            'user_id' => 1, // Assuming user with id 1 exists
        ]);

        Invoice::create([
            'total' => '300.00',
            'vat_percentage' => '5%',
            'vat_amount' => '30.00',
            'payable' => '315.00',
            'cus_details' => 'Alice Smith, 789 Maple Ave, Bigcity, Country',
            'ship_details' => 'Bob Smith, 101 Pine Ln, Smalltown, Country',
            'tran_id' => 'TRX987654',
            'val_id' => 'VAL456',
            'delivery_status' => 'Processing',
            'payment_status' => 'Paid',
            'user_id' => 2, // Assuming user with id 2 exists
        ]);

    }
}

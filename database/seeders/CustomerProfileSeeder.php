<?php

namespace Database\Seeders;

use App\Models\CustomerProfile;
use Illuminate\Database\Seeder;

class CustomerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerProfile::create([
            'cus_name' => 'John Doe',
            'cus_add' => '123 Main St',
            'cus_city' => 'New York',
            'cus_state' => 'NY',
            'cus_postcode' => '10001',
            'cus_country' => 'USA',
            'cus_phone' => '1234567890',
            'cus_fax' => '0987654321',

            'ship_name' => 'John Doe',
            'ship_add' => '123 Main St',
            'ship_city' => 'New York',
            'ship_state' => 'NY',
            'ship_postcode' => '10001',
            'ship_country' => 'USA',
            'ship_phone' => '1234567890',

            'user_id' => 1,
        ]);
    }
}

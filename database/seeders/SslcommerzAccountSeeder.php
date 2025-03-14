<?php

namespace Database\Seeders;

use App\Models\SslcommerzAccount;
use Illuminate\Database\Seeder;

class SslcommerzAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SslcommerzAccount::create([
            'store_id' => 'jaind67b7781ea1ab5',
            'store_passwd' => 'jaind67b7781ea1ab5@ssl',
            'currency' => 'BDT',
            'success_url' => 'http://127.0.0.1:8000/payment-success',
            'fail_url' => 'http://127.0.0.1:8000/payment-fail',
            'cancel_url' => 'http://127.0.0.1:8000/payment-cancel',
            'ipn_url' => 'http://127.0.0.1:8000/api/payment-ipn',
            'init_url' => 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php',
        ]);
    }
}

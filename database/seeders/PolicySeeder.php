<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Policy::create([
            'type' => 'about',
            'des' => 'This is the About policy, explaining our company’s mission, vision, and values.',
        ]);

        Policy::create([
            'type' => 'refund',
            'des' => 'This is the Refund policy, outlining the conditions and process for requesting a refund.',
        ]);

        Policy::create([
            'type' => 'terms',
            'des' => 'These are the Terms and Conditions that apply when using our website and services.',
        ]);

        Policy::create([
            'type' => 'how to buy',
            'des' => 'This is the guide for How to Buy products on our website, with detailed instructions.',
        ]);

        Policy::create([
            'type' => 'contact',
            'des' => 'This is the Contact policy, explaining how customers can reach our support team.',
        ]);

        Policy::create([
            'type' => 'complain',
            'des' => 'This is the Complain policy, detailing how customers can submit complaints about our services.',
        ]);
    }
}

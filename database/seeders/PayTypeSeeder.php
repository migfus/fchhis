<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => env('SEEDER_PAY_TYPE_MONTHLY_ID', 'no id'),
                'name' => 'Monthly',
            ],
            [
                'id' => env('SEEDER_PAY_TYPE_QUARTERLY_ID', 'no id'),
                'name' => 'Quarterly',
            ],
            [
                'id' => env('SEEDER_PAY_TYPE_SEMI_ANNUAL_ID', 'no id'),
                'name' => 'Semi-Annual',
            ],
            [
                'id' => env('SEEDER_PAY_TYPE_ANNUAL_ID', 'no id'),
                'name' => 'Annual',
            ],
            [
                'id' => env('SEEDER_PAY_TYPE_SPOT_PAYMENT_ID', 'no id'),
                'name' => 'Spot Payment',
            ],
            [
                'id' => env('SEEDER_PAY_TYPE_SPOT_SERVICE_ID', 'no id'),
                'name' => 'Spot Service',
            ],
        ];

        foreach($data as $row) {
            \App\Models\PayType::create($row);
        }
    }
}

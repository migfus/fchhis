<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run(): void {
        Transaction::create([
            'or' => '[or number]',
            'agent_id' => env('SEEDER_USER_AGENT_ID', 'no id'),
            'client_id' => env('SEEDER_USER_CLIENT_ID', 'no id'),
            'staff_id' => env('SEEDER_USER_STAFF_ID', 'no id'),
            'plan_detail_id' => env('SEEDER_PLAN_JASPER_ID', 'no id'),
            'pay_type_id' => env('SEEDER_PAY_TYPE_QUARTERLY_ID', 'no id'), // querterly

            'amount' => 1250,
        ]);

        Transaction::create([
            'or' => '[or number 2]',
            'agent_id' => env('SEEDER_USER_AGENT_ID', 'no id'),
            'client_id' => env('SEEDER_USER_CLIENT_ID', 'no id'),
            'plan_detail_id' => env('SEEDER_PLAN_JASPER_ID', 'no id'),
            'staff_id' => env('SEEDER_USER_STAFF_ID', 'no id'),
            'pay_type_id' => env('SEEDER_PAY_TYPE_QUARTERLY_ID', 'no id'), // querterly

            'amount' => 1250,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => env('SEEDER_BRANCH_VALENCIA_ID', 569913442237459),
                'region_id' => env('SEEDER_REGION_X_ID', null),
                'name' => 'Valencia City'
            ]
        ];

        foreach($data as $row) {
            \App\Models\Branch::create($row);
        }
    }
}

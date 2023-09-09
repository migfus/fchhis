<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => env('SEEDER_REGION_X_ID', 569914152489794),
                'name' => 'Region X',
            ]
        ];

        foreach($data as $row) {
            \App\Models\Region::create($row);
        }
    }
}

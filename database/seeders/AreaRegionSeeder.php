<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaRegionSeeder extends Seeder
{
    public function run(): void {
      $data = [
          [
              'id' => env('SEEDER_AREA_REGION_X_ID', 569914152489794),
              'name' => 'Region X',
          ]
      ];

      foreach($data as $row) {
        \App\Models\AreaRegion::create($row);
      }
    }
}

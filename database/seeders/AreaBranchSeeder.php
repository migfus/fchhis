<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaBranchSeeder extends Seeder
{
    public function run(): void {
      $data = [
        [
          'id' => env('SEEDER_AREA_BRANCH_VALENCIA_ID', 569913442237459),
          'area_region_id' => env('SEEDER_AREA_REGION_X_ID', null),
          'name' => 'Valencia City'
        ]
      ];

      foreach($data as $row) {
        \App\Models\AreaBranch::create($row);
      }
    }
}

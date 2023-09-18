<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AddressSQL::class,

            RoleAndPermissionsSeeder::class,

            FAQSeeder::class,
            EventCategorySeeder::class,
            EventSeeder::class,
            // EligibilitySeeder::class,

            PlanSeeder::class, //plan & planDetails
            PayTypeSeeder::class,
            RegionSeeder::class,
            BranchSeeder::class,
            BeneficiarySeeder::class,

            UserSeeder::class,
            TransactionSeeder::class,

            PostCategorySeeder::class,
            PostSeeder::class,

            LogCategorySeeder::class,
        ]);
    }
}

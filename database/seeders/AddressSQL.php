<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSQL extends Seeder
{
    public function run(): void
    {
        $path = 'database/sql/location.sql';
        DB::unprepared(file_get_contents($path));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    public function run(): void {
        $data = [
            [
                'id' => 549717375739226,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'name' => 'Holiday',
                'bg_color' => '16A34A',
                'text_color' => 'fff',
            ],
            [
                'id' => 549717375753077,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'name' => 'Event',
                'bg_color' => 'FBBF24',
                'text_color' => '000',
            ]
        ];

        foreach($data as $row) {
            \App\Models\EventCategory::create($row);
        }
    }
}

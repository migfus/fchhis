<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void {
        $data = [
            [
                'id' => 549717636166929,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'event_category_id' => \App\Models\EventCategory::where('id', 549717375739226)->first()->id, // HOliday
                'title' => 'Buenas Deas sheess',
                'start' => Carbon::now()->add(3, 'day'),
                'end' => Carbon::now()->add(4, 'day'),
            ],
            [
                'id' => 549717636175937,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'event_category_id' => \App\Models\EventCategory::where('id', 549717375753077)->first()->id, // Event
                'title' => 'FCHHIS Event',
                'start' => Carbon::now()->add(1, 'day'),
                'end' => Carbon::now()->add(3, 'day'),
            ],
        ];

        foreach($data as $row) {
            \App\Models\Event::create($row);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    public function run(): void {
        $data = [
            [
                'id' => 549718929043076,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'name' => 'News'
            ],
            [
                'id' => 549718929052672,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'name' => 'Updates',
            ],
        ];

        foreach($data as $row) {
            \App\Models\PostCategory::create($row);
        }
    }
}

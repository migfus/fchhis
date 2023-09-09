<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void {
        $data = [
            [
                'id' => 549719100815648,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'post_category_id' => \App\Models\PostCategory::where('id', 549718929043076)->first()->id, //news
                'active' => 1,
                'title'   => 'Lorem Ipsum',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
                'cover'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
            ],
            [
                'id' => 549719100826776,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'post_category_id' => \App\Models\PostCategory::where('id', 549718929052672)->first()->id, // updates
                'active' => 1,
                'title'   => 'Lorem Ipsum',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
                'cover'   => 'https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
            ],
            [
                'id' => 549719100837584,
                'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
                'post_category_id' => \App\Models\PostCategory::where('id', 549718929043076)->first()->id, //news
                'active' => 1,
                'title'   => 'Lorem Ipsum',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
                'cover'   => 'https://images.unsplash.com/photo-1492724441997-5dc865305da7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
            ]
        ];


        foreach($data as $row) {
            \App\Models\Post::create($row);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    public function run(): void {
      $data = [
        [
          'id' => 549717769433411,
          'answer_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'approved_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'question' => 'Proident nostrud magna enim irure reprehenderit in ut aliqua officia mollit nulla.',
          'answer' => 'Ullamco velit aliquip ex ad. Mollit eu reprehenderit nisi laboris excepteur eiusmod ex incididunt labore ut incididunt cillum minim. Lorem id velit sunt aliqua veniam commodo. Ad elit ipsum do minim.',
          'points' => 100,
        ],
        [
          'id' => 549717769449759,
          'answer_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'approved_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'question' => 'Pariatur duis aliqua qui occaecat occaecat cillum esse elit consectetur.',
          'answer' => 'Sunt ullamco velit est adipisicing mollit eiusmod fugiat enim consectetur magna. Commodo veniam minim minim ex reprehenderit nulla. Nostrud consectetur ex voluptate ea deserunt anim ex pariatur ullamco anim consectetur ex enim. ',
          'points' => 102,
        ],
        [
          'id' => 549717769466666,
          'answer_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'approved_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'question' => 'Veniam ad mollit aute in enim velit ad proident duis anim excepteur sint fugiat occaecat.',
          'answer' => 'Adipisicing aute ullamco dolore duis velit deserunt duis esse qui mollit fugiat sit consectetur sit. Fugiat et fugiat ipsum eu pariatur. Labore proident Lorem aliqua in anim eu sint est. Voluptate sint sit deserunt excepteur id sit.',
          'points' => 103,
        ],
        [
          'id' => 549717769479859,
          'answer_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'approved_user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'question' => 'Incididunt laboris consectetur duis voluptate sunt nulla amet.',
          'answer' => 'Minim ut et fugiat pariatur aute laborum occaecat minim ea fugiat. Magna cillum sint tempor eiusmod veniam consectetur fugiat ea sit enim adipisicing. Est sint Lorem cupidatat velit voluptate ut aliquip ea nisi reprehenderit exercitation ex eu velit.',
          'points' => 104,
        ],
      ];

      foreach($data as $row) {
        \App\Models\FAQ::create($row);
      }
    }
}

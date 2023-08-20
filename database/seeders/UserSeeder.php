<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Person;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => $_ENV['SEEDER_PERSON_ADMIN_ID'], //admin [first user],
        'user_id' => $_ENV['SEEDER_PERSON_ADMIN_ID'],
        'last_name' => 'Admin',
        'first_name' => '',
        'mid_name' => '',
        'ext_name' => '',
        'civil_status_id' => \App\Models\CivilStatus::get()->first()->id, // single
        'birth_day' => Carbon::now(),
        'birth_place_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'blood_type_id' => \App\Models\BloodType::get()->first()->id, // O+
        'sex' => 1,
        'height' => 1.6,
        'weight' => 65.1,
        'address_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'address' => 'Bonifacion Street, Poblacion',
      ],
    ];

    foreach($data as $row) {
      $person = \App\Models\Person::create($row);
      $this->CreateNumber($person->id);
    }

    User::create(
      [
        'id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
        'email' => 'admin@gmail.com',
        'password'=> Hash::make('12345678'),
        'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ],
    )->assignRole('Admin');
  }

  private function CreateNumber($personID): void {
    \App\Models\MobileNumber::create([
      'person_id' => $personID,
      'allow_notify' => 1,
      'number' => rand(0, 999999999),
    ]);
  }

}

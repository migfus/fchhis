<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Info;

class UserSeeder extends Seeder
{
    public function run(): void {
        // NOTE ADMIN
        User::create([
            'id' => env('SEEDER_USER_ADMIN_ID', 'no id'),
            'region_id' => null, // has access to all regino
            'branch_id' => null,
            'email' => 'admin@gmail.com',
            'name' => '[admin]',
            'password'=> Hash::make('12345678'),
            'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
        ])->assignRole('Admin');

        // NOTE REGIONAL MANAGER
        User::create([
            'id' => env('SEEDER_USER_REGIONAL_MANAGER_ID', 'no id'),
            'region_id' => env('SEEDER_REGION_X_ID', 'no id'),
            'branch_id' => null,
            'email' => 'regional@gmail.com',
            'name' => '[regional manager]',
            'password'=> Hash::make('12345678'),
            'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
        ])->assignRole('Regional Manager');

        // NOTE BRANCH MANAGER
        User::create([
            'id' => env('SEEDER_USER_BRANCH_MANAGER_ID', 'no id'),
            'region_id' => env('SEEDER_REGION_X_ID', 'no id'),
            'branch_id' => env('SEEDER_BRANCH_VALENCIA_ID', 'no id'),
            'email' => 'branch@gmail.com',
            'name' => '[branch manager]',
            'password'=> Hash::make('12345678'),
            'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
        ])->assignRole('Branch Manager');

        // NOTE STAFF
        User::create([
            'id' => env('SEEDER_USER_STAFF_ID', 'no id'),
            'region_id' => env('SEEDER_REGION_X_ID', 'no id'),
            'branch_id' => env('SEEDER_BRANCH_VALENCIA_ID', 'no id'),
            'email' => 'staff@gmail.com',
            'name' => '[staff]',
            'password'=> Hash::make('12345678'),
            'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
        ])->assignRole('Staff');


        // NOTE AGENT
        $user = User::create([
            'id' => env('SEEDER_USER_AGENT_ID', 'no id'),
            'region_id' => env('SEEDER_REGION_X_ID', 'no id'),
            'branch_id' => env('SEEDER_BRANCH_VALENCIA_ID', 'no id'),
            'email' => 'agent@gmail.com',
            'name' => '[agent]',
            'password'=> Hash::make('12345678'),
            'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
        ])->assignRole('Agent');
        Info::create([
            'user_id' => $user->id,
            'staff_id' => env('SEEDER_USER_STAFF_ID', 'no id'),
            'agent_id' => env('SEEDER_USER_ADMIN_ID', 'no id'),
            'plan_details_id' => env('SEEDER_PLAN_BERYL_ID', 'no id'),
            'pay_type_id'=> env("SEEDER_PAY_TYPE_MONTHLY_ID", null),
            'bday' => '2022-02-02',
            'bplace_id' => 64,
            'sex' => true,
            'address' => 'agent\s Address',
            'address_id' => 64,
            'due_at' => null,
            'fulfilled_at' => null,
            'or' => null,
            'cell' => 9978663855,
        ]);

        // NOTE CLIENT
        $user = User::create([
            'id' => env('SEEDER_USER_CLIENT_ID', 'no id'),
            'region_id' => env('SEEDER_REGION_X_ID', 'no id'),
            'branch_id' => env('SEEDER_BRANCH_VALENCIA_ID', 'no id'),
            'email' => 'migfus20@gmail.com',
            'name' => '[client]',
            'password'=> Hash::make('12345678'),
            'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
        ])->assignRole('Client');
        Info::create([
            'user_id' => $user->id,
            'staff_id' => env('SEEDER_USER_STAFF_ID', 'no id'),
            'agent_id' => env('SEEDER_USER_AGENT_ID', 'no id'),
            'plan_details_id' => env('SEEDER_PLAN_BERYL_ID', 'no id'),
            'pay_type_id'=> env("SEEDER_PAY_TYPE_MONTHLY_ID", null),
            'bday' => '2022-02-02',
            'bplace_id' => 64,
            'sex' => true,
            'address' => 'client\s Address',
            'address_id' => 64,
            'due_at' => null,
            'fulfilled_at' => null,
            'or' => null,
            'cell' => 9978887777,
        ]);

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Ottaviano\Faker\Gravatar($faker));
        foreach(range(1, 20) as $idx) {
            $user = User::create([
                'region_id' => env('SEEDER_REGION_X_ID', 'no id'),
                'branch_id' => env('SEEDER_BRANCH_VALENCIA_ID', 'no id'),
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => Hash::make('12345678'),
            ])->assignRole('Client');
            Info::create([
                'user_id' => $user->id,
                'staff_id'  => env('SEEDER_USER_STAFF_ID', null),
                'agent_id'  => env('SEEDER_USER_AGENT_ID', null),
                'bday'      => Carbon::today()->subDays(rand(0, 365)),
                'bplace_id' => rand(1, 1000),
                'sex' => rand(0, 1),
                'address_id' => rand(1, 1000),
                'address' => $idx . '] address',
                'pay_type_id'=> env("SEEDER_PAY_TYPE_MONTHLY_ID", null),
                'plan_details_id'    => env('SEEDER_PLAN_JASPER_ID', null),
                'cell' => rand(111111111, 999999999),
                'due_at'    => Carbon::today()->addDays(rand(0, 90))
            ]);
        }
    }

}

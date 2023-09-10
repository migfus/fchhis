<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    public function run(): void {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // NOTE USERS
        Permission::create(['name' => 'index beneficiary']);

        // NOTE TRANSACTIONS
        Permission::create(['name' => 'index transaction']);

        // NOTE USERS
        // Permission::create(['name' => 'index user']);
        // Permission::create(['name' => 'store user']);
        // Permission::create(['name' => 'update user']);
        // Permission::create(['name' => 'destroy user']);

        // NOTE POSTS
        // Permission::create(['name' => 'index post']);
        // Permission::create(['name' => 'store post']);
        // Permission::create(['name' => 'update post']);
        // Permission::create(['name' => 'destroy post']);

        // NOTE FAQS
        // Permission::create(['name' => 'index faq']);
        // Permission::create(['name' => 'store faq']);
        // Permission::create(['name' => 'update faq']);
        // Permission::create(['name' => 'destroy faq']);

        // NOTE EVENTS/CALENDAR
        // Permission::create(['name' => 'index event']);
        // Permission::create(['name' => 'store event']);
        // Permission::create(['name' => 'update event']);
        // Permission::create(['name' => 'destroy event']);

        // NOTE AUTH
        Permission::create(['name' => 'index auth']);
        Permission::create(['name' => 'dashboard auth']);
        Permission::create(['name' => 'update auth']);

        // NOTE DASHBOARD
        // Permission::create(['name' => 'index dashboard']);
        // Permission::create(['name' => 'store dashboard']);
        // Permission::create(['name' => 'update dashboard']);
        // Permission::create(['name' => 'destroy dashboard']);

        // NOTE ADMIN
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth',
            'index beneficiary',
            'index transaction',
        ]);

        // NOTE REGIONAL MANAGER
        $role = Role::create(['name' => 'Regional Manager']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth',
            'index beneficiary',
            'index transaction',
        ]);

        // NOTE BRANCH MANAGER
        $role = Role::create(['name' => 'Branch Manager']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth',
            'index beneficiary',
            'index transaction',
        ]);

        // NOTE STAFF
        $role = Role::create(['name' => 'Staff']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth',
            'index beneficiary',
            'index transaction',
        ]);

        // NOTE AGENT
        $role = Role::create(['name' => 'Agent']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth',
            'index beneficiary',
            'index transaction',
        ]);

        // NOTE CLIENT
        $role = Role::create(['name' => 'Client']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth',
            'index beneficiary',
            'index transaction',
        ]);
    }
}

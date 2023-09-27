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

        // NOTE PAYMENT TYPE
        Permission::create(['name' => 'index payment-type']);
        Permission::create(['name' => 'show payment-type']);
        Permission::create(['name' => 'download payment-type']);
        Permission::create(['name' => 'create payment-type']);
        Permission::create(['name' => 'update payment-type']);
        Permission::create(['name' => 'destroy payment-type']);

        // NOTE PLAN
        Permission::create(['name' => 'index plan']);
        Permission::create(['name' => 'show plan']);
        Permission::create(['name' => 'download plan']);
        Permission::create(['name' => 'create plan']);
        Permission::create(['name' => 'update plan']);
        Permission::create(['name' => 'destroy plan']);

        // NOTE USERS
        Permission::create(['name' => 'index beneficiary']);
        Permission::create(['name' => 'download beneficiary']);
        Permission::create(['name' => 'create beneficiary']);
        Permission::create(['name' => 'update beneficiary']);
        Permission::create(['name' => 'destroy beneficiary']);

        // NOTE TRANSACTIONS
        Permission::create(['name' => 'index transaction']);
        Permission::create(['name' => 'show transaction']);
        Permission::create(['name' => 'download transaction']);
        Permission::create(['name' => 'create transaction']);
        Permission::create(['name' => 'update transaction']);
        Permission::create(['name' => 'destroy transaction']);

        // NOTE USERS
        Permission::create(['name' => 'index client']);
        Permission::create(['name' => 'show client']);
        Permission::create(['name' => 'download client']);
        Permission::create(['name' => 'create client']);
        Permission::create(['name' => 'update client']);
        Permission::create(['name' => 'destroy client']);

        // NOTE AGENTS
        Permission::create(['name' => 'index agent']);
        Permission::create(['name' => 'show agent']);
        Permission::create(['name' => 'download agent']);
        Permission::create(['name' => 'create agent']);
        Permission::create(['name' => 'update agent']);
        Permission::create(['name' => 'destroy agent']);

        // NOTE USERS
        Permission::create(['name' => 'summary user']);
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
            'index auth', 'dashboard auth', 'update auth', // full access of account-settings (own)
            'index payment-type', 'create payment-type', 'update payment-type', 'destroy payment-type', 'download payment-type',// [manage] payment-type [all]
            'index plan', 'create plan', 'update plan', 'destroy plan', 'download plan',// [manage] plan [all]
            'index beneficiary', 'create beneficiary', 'update beneficiary', 'destroy beneficiary', 'download beneficiary',// [manage] beneficiary [all]
            'index transaction', 'show transaction', 'create transaction', 'update transaction', 'destroy transaction', 'download transaction', // [manage] transactions [all]

            'index agent', 'show agent', 'create agent', 'update agent', 'destroy agent', 'download agent', // [manage] of agent [all]
            'index client', 'show client', 'create client', 'update client', 'destroy client', 'download client', // [manage] of client [all]
            'summary user', // get count in [staff, agent, client, beneficiary]
        ]);

        // NOTE REGIONAL MANAGER
        $role = Role::create(['name' => 'Regional Manager']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth', // full access of account-settings (own)
            'index payment-type', 'create payment-type', 'update payment-type', 'destroy payment-type', 'download payment-type',// [manage] payment-type [all]
            'index plan', 'create plan', 'update plan', 'destroy plan', 'download plan',// [manage] plan [all]

            'index beneficiary', 'create beneficiary', 'update beneficiary', 'destroy beneficiary', 'download beneficiary',// [manage] beneficiary [all]
            'index transaction', 'show transaction', 'create transaction', 'update transaction', 'destroy transaction', 'download transaction', // [manage] transactions [all]

            'index agent', 'show agent', 'create agent', 'update agent', 'destroy agent', 'download agent', // [manage] of agent [all]
            'index client', 'show client', 'create client', 'update client', 'destroy client', 'download client', // [manage] of client [all]
            'summary user', // get count in [staff, agent, client, beneficiary]
        ]);

        // NOTE BRANCH MANAGER
        $role = Role::create(['name' => 'Branch Manager']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth', // full access of account-settings (own)
            'index payment-type', 'create payment-type', 'update payment-type', 'destroy payment-type', 'download payment-type',// [manage] payment-type [all]
            'index plan', 'create plan', 'update plan', 'destroy plan', 'download plan',// [manage] plan [all]
            'index beneficiary', 'create beneficiary', 'update beneficiary', 'destroy beneficiary', 'download beneficiary',// [manage] beneficiary [all]
            'index transaction', 'show transaction', 'create transaction', 'update transaction', 'destroy transaction', 'download transaction', // [manage] transactions [all]

            'index agent', 'show agent', 'create agent', 'update agent', 'destroy agent', 'download agent', // [manage] of agent [all]
            'index client', 'show client', 'create client', 'update client', 'destroy client', 'download client', // [manage] of client [all]
            'summary user', // get count in [staff, agent, client, beneficiary]
        ]);

        // NOTE ✅ STAFF
        $role = Role::create(['name' => 'Staff']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth', // full access of account-settings (own)
            'index payment-type', // list only payment-type
            'index plan',// list only plan
            'index beneficiary', 'create beneficiary', 'download beneficiary',// [list, create, update(self id), download] of beneficiary under [all]
            'index transaction', 'show transaction', 'create transaction', 'update transaction', 'download transaction', // [list, show, create, update(self id), download] of transactions under [all]

            'index agent', 'show agent', 'create agent', 'update agent', 'download agent', // [list, show, create, update(self id), download] of agent [all]
            'index client', 'show client', 'create client', 'update client', 'download client', // [list, show, create, update(self id), download] of client [all]
            'summary user', // get count in [agent, client, beneficiary]
        ]);

        // NOTE ✅ AGENT
        $role = Role::create(['name' => 'Agent']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth', // full access of account-settings (own)
            'index beneficiary', 'download beneficiary',// list/ of beneficiary under [agent_id > user > beneficiary]
            'index transaction', 'show transaction', 'download transaction', // [list, details, download] of transactions under [agent_id]

            'index client', 'show client', 'download client', // [list, details, download] of client under [agent_id]
            'summary user', // get count in [client, beneficiary],
        ]);

        // NOTE ✅ CLIENT
        $role = Role::create(['name' => 'Client']);
        $role->givePermissionTo([
            'index auth', 'dashboard auth', 'update auth', // full access of account-settings (own)
            'index beneficiary', // view list of beneficiary (own)
            'index transaction', // view list of transactions (own)
        ]);
    }
}

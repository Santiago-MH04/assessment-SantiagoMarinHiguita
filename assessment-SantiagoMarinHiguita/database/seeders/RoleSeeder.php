<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            //Roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePhysician = Role::create(['name' => 'physician']);
        $roleUser = Role::create(['name' => 'user']);

            //Permissions
                //User permissions
        $permissionShow = Permission::create(['name' => 'show.appointments'])->syncRoles([$roleAdmin, $roleUser]);


        $permissionCreate = Permission::create(['name' => 'create.raffles'])->assignRole($roleAdmin);
        $permissionUpdate = Permission::create(['name' => 'update.raffles'])->assignRole($roleAdmin);
        $permissionDelete = Permission::create(['name' => 'delete.raffles'])->assignRole($roleAdmin);

        $permissionShowGambling = Permission::create(['name' => 'show.gamblingRaffles'])->assignRole($roleUser);
        $permissionEnroll = Permission::create(['name' => 'enroll.raffles'])->assignRole($roleUser);
        $permissionPay = Permission::create(['name' => 'pay.raffles'])->assignRole($roleUser);
    }
}

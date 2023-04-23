<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //all permissions
        $permissions=[
            'create_admin',
            'edit_admin',
            'delete_admin',
            'view_admin',

            'view_entreprise',
            'delete_entreprise',
            'create_entreprise',
            'edit_entreprise',

            'view_employe',
            'edit_employe',

            'send_invite',

        ];
        $role= Role::where('name','admin')->first();
        foreach ($permissions as  $permission) {

            $new_permission=Permission::firstOrCreate(['name' => $permission]);
            //give permissions to admin role
            $role->givePermissionTo($new_permission);

        }

        $employe_permissions=[
            'view_entreprise',
            'view_employe',
            'edit_employe',
        ];
        $role= Role::where('name','employe')->first();
        foreach ($employe_permissions as  $permission) {

            $new_permission=Permission::firstOrCreate(['name' => $permission]);
            //give permissions to employe role
            $role->givePermissionTo($new_permission);
            
        }
    }
}

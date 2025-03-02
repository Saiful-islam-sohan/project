<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

     
        $createProductPermission = Permission::firstOrCreate(['name' => 'create-products']);
        $editProductPermission = Permission::firstOrCreate(['name' => 'edit-products']);
        $deleteProductPermission = Permission::firstOrCreate(['name' => 'delete-products']);

        
        $adminRole->givePermissionTo([$createProductPermission, $editProductPermission, $deleteProductPermission]);
        $userRole->givePermissionTo($createProductPermission);

       
        $user = \App\Models\User::find(14);
        if ($user) {
            $user->assignRole('Admin');
        }
    }
}

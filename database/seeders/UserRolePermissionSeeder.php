<?php

namespace  Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create Permissions
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'view roles']);

        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);
        Permission::create(['name' => 'view permissions']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'read products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);

        Permission::create(['name' => 'create logs']);
        Permission::create(['name' => 'read logs']);
        Permission::create(['name' => 'update logs']);
        Permission::create(['name' => 'delete logs']);
        Permission::create(['name' => 'view logs']);


        $adminRole = Role::create(['name' => 'admin']);


        $adminRole->givePermissionTo(['create roles', 'read roles', 'view roles', 'update roles']);
        $adminRole->givePermissionTo(['create permissions', 'read permissions', 'view permissions']);
        $adminRole->givePermissionTo(['create users', 'read users', 'view users', 'update users']);
        $adminRole->givePermissionTo(['create logs', 'read logs', 'view logs', 'update logs']);





        // Create Admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        );
        $adminUser->assignRole('admin');
    }
}

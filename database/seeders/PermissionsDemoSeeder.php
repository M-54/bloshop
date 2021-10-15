<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_superAdmin = Role::create(['name' => 'super-admin']);

        /**
         * @var $role_admin Role
         */
        $role_admin = Role::create(['name' => 'admin']);

        $role_writer = Role::create(['name' => 'writer']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);

        Permission::create(['name' => 'edit comments']);
        Permission::create(['name' => 'delete comments']);

        //$role_admin->givePermissionTo('create users');
        $role_admin->givePermissionTo('edit users');
        $role_admin->givePermissionTo('publish posts');
        $role_admin->givePermissionTo('edit comments');
        $role_admin->givePermissionTo('delete comments');

        $role_writer->givePermissionTo('create posts');
        $role_writer->givePermissionTo('edit posts');
        $role_writer->givePermissionTo('delete posts');

        /**
         * @var $user User
         */
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole($role_superAdmin);
    }
}

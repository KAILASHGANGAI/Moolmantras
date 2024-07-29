<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'store']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'unpublish']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'vendor']);
        $role1->givePermissionTo('store');
        $role1->givePermissionTo('update');
        $role1->givePermissionTo('edit');
        $role1->givePermissionTo('view');
        $role1->givePermissionTo('delete');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish');
        $role2->givePermissionTo('unpublish');

        $role3 = Role::create(['name' => 'SuperAdmin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role4 = Role::create(['name'=>'visitor']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'vendor User',
            'email' => 'vendor@gmail.com',
            'password'=> Hash::make('password')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password'=> Hash::make('password')

        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'email' => 'superadmin@gmail.com',
            'password'=> Hash::make('password')

        ]);
        $user->assignRole($role3);


        $user = \App\Models\User::factory()->create([
            'name' => 'visitor User',
            'email' => 'visitor@gmail.com',
            'password'=> Hash::make('password')

        ]);
        $user->assignRole($role4);
    }
}

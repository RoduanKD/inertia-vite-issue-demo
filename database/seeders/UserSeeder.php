<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'superadmin']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo('superadmin');

        $user = User::factory(1)->create([
            'name' => 'SuperAdmin',
            'email' => 'roduan98@gmail.com',
        ])->first();

        $user->assignRole($role);
    }
}

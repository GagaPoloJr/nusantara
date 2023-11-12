<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'image' => 'assets/images/default.jpg'
        ];
        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'nik' => null,
                'user_name' => 'Administrator',
                'email' => 'superadmin@gmail.com',
                'gender' => 'L',
                'no_hp' => '085648007953',
                'image' => null,
                'cross_company' => true,
            ], $default_user_value));

            $role_admin = Role::create([
                'name' => 'Admin',
                'company_id' => null,
            ]);

            $role_user = Role::create([
                'name' => 'User',
                'company_id' => null,
            ]);

            Role::create([
                'name' => 'IT GROUP SBY',
                'company_id' => 'SBYNSA',
            ]);

            Role::create([
                'name' => 'IT GROUP DMK',
                'company_id' => 'SMGNBI',
            ]);

            Role::create([
                'name' => 'PIC NBI',
                'company_id' => 'SMGNBI',
            ]);

            Role::create([
                'name' => 'PIC NUSA',
                'company_id' => 'SBYNSA',
            ]);

            Role::create([
                'name' => 'PIC NJRM',
                'company_id' => 'NJRBJM',
            ]);

            Role::create([
                'name' => 'PIC ITGROUP',
                'company_id' => 'SMGNBI',
            ]);

            Role::create([
                'name' => 'ADM NUSA',
                'company_id' => 'SBYNSA',
            ]);

            $admin->assignRole($role_admin);
            $admin->assignRole($role_user);

            Permission::create(['name' => 'create group']);
            Permission::create(['name' => 'create access']);
            Permission::create(['name' => 'create user']);
            Permission::create(['name' => 'create menu']);
            Permission::create(['name' => 'create dictionary']);
            Permission::create(['name' => 'create dictionarydata']);
            Permission::create(['name' => 'create company']);
            Permission::create(['name' => 'create option']);

            Permission::create(['name' => 'read konfigurasi']);
            Permission::create(['name' => 'read group']);
            Permission::create(['name' => 'read access']);
            Permission::create(['name' => 'read user']);
            Permission::create(['name' => 'read menu']);
            Permission::create(['name' => 'read dictionary']);
            Permission::create(['name' => 'read dictionarydata']);
            Permission::create(['name' => 'read company']);
            Permission::create(['name' => 'read option']);

            Permission::create(['name' => 'update group']);
            Permission::create(['name' => 'update access']);
            Permission::create(['name' => 'update user']);
            Permission::create(['name' => 'update menu']);
            Permission::create(['name' => 'update dictionary']);
            Permission::create(['name' => 'update dictionarydata']);
            Permission::create(['name' => 'update company']);
            Permission::create(['name' => 'update option']);

            Permission::create(['name' => 'delete group']);
            Permission::create(['name' => 'delete access']);
            Permission::create(['name' => 'delete user']);
            Permission::create(['name' => 'delete menu']);
            Permission::create(['name' => 'delete dictionary']);
            Permission::create(['name' => 'delete dictionarydata']);
            Permission::create(['name' => 'delete company']);
            Permission::create(['name' => 'delete option']);

            $role_admin->givePermissionTo('create group');
            $role_admin->givePermissionTo('create access');
            $role_admin->givePermissionTo('create user');
            $role_admin->givePermissionTo('create menu');
            $role_admin->givePermissionTo('create dictionary');
            $role_admin->givePermissionTo('create dictionarydata');
            $role_admin->givePermissionTo('create company');
            $role_admin->givePermissionTo('create option');

            $role_admin->givePermissionTo('read konfigurasi');
            $role_admin->givePermissionTo('read group');
            $role_admin->givePermissionTo('read access');
            $role_admin->givePermissionTo('read user');
            $role_admin->givePermissionTo('read menu');
            $role_admin->givePermissionTo('read dictionary');
            $role_admin->givePermissionTo('read dictionarydata');
            $role_admin->givePermissionTo('read company');
            $role_admin->givePermissionTo('read option');

            $role_admin->givePermissionTo('update group');
            $role_admin->givePermissionTo('update access');
            $role_admin->givePermissionTo('update user');
            $role_admin->givePermissionTo('update menu');
            $role_admin->givePermissionTo('update dictionary');
            $role_admin->givePermissionTo('update dictionarydata');
            $role_admin->givePermissionTo('update company');
            $role_admin->givePermissionTo('update option');

            $role_admin->givePermissionTo('delete group');
            $role_admin->givePermissionTo('delete access');
            $role_admin->givePermissionTo('delete user');
            $role_admin->givePermissionTo('delete menu');
            $role_admin->givePermissionTo('delete dictionary');
            $role_admin->givePermissionTo('delete dictionarydata');
            $role_admin->givePermissionTo('delete company');
            $role_admin->givePermissionTo('delete option');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}

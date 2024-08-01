<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'auth-user'],
            ['name' => 'auth-admin'],
            ['name' => 'admin-user'],
            ['name' => 'admin-brand'],
            ['name' => 'admin-type'],
            ['name' => 'admin-size'],
            ['name' => 'admin-product'],
            ['name' => 'user-cart'],
            ['name' => 'user-order'],
            ['name' => 'admin-order'],
        ];
        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }

        $roles = [
            ['name' => 'Super Admin'],
            ['name' => 'Admin'],
            ['name' => 'User'],
        ];
        foreach ($roles as $key => $value) {
            $role = Role::create($value);
            if ($role->name == 'Super Admin') {
                $role->givePermissionTo('admin-user');
                $role->givePermissionTo('admin-brand');
                $role->givePermissionTo('admin-type');
                $role->givePermissionTo('admin-size');
                $role->givePermissionTo('admin-product');
                $role->givePermissionTo('admin-order');
                $role->givePermissionTo('auth-admin');
            }
            if ($role->name == 'Admin') {
                $role->givePermissionTo('admin-brand');
                $role->givePermissionTo('admin-type');
                $role->givePermissionTo('admin-size');
                $role->givePermissionTo('admin-product');
                $role->givePermissionTo('admin-order');
                $role->givePermissionTo('auth-admin');
            }
            if ($role->name == 'User') {
                $role->givePermissionTo('user-cart');
                $role->givePermissionTo('user-order');
                $role->givePermissionTo('auth-user');
            }
        }
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'super.admin@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($user->name);
        }
    }
}

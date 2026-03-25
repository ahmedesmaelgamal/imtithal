<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add static roles
        $adminRole = Role::create([
            'name' => 'مدير النظام',
            'guard_name' => 'web',
        ]);

        $supervisorRole = Role::create([
            'name' => 'مشرف',
            'guard_name' => 'user',
        ]);

        $monitorRole = Role::create([
            'name' => 'مراقب',
            'guard_name' => 'user',
        ]);

        // add dynamic roles and sync permissions
        $adminRole->syncPermissions([
            'reports',
            'notifications',
            'notices',
            'axes',
            'users',
            'roles',
            'daily_reports',
            'logs',
            'admins',
            'settings',
            'supports',
            'seasons',
        ]);

        $supervisorRole->syncPermissions([
            'reports',
            'notifications',
            'notices',
            'axes',
            'users',
            'daily_reports',
            'supports',
        ]);

        $monitorRole->syncPermissions([
            'reports',
            'notifications',
            'notices',
            'daily_reports',
        ]);
    }
}

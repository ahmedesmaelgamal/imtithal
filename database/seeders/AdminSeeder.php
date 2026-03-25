<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $admin =  Admin::create([
            'full_name' => 'مدير النظام',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'national_id' => '123456789',
            'password' => bcrypt('123456789'),
        ]);

      $admin->assignRole('مدير النظام');
    }
}

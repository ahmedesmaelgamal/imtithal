<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DummyDataSeeder::class);


//        \App\Models\User::factory(25)->create();
//        \App\Models\Axis::factory(25)->create();
//
//        \App\Models\Admin::factory(25)->create();
//        \App\Models\Alert::factory(25)->create();
//        \App\Models\AlertLeader::factory(25)->create();
//        \App\Models\AlertUser::factory(25)->create();
//        \App\Models\Area::factory(25)->create();
//        \App\Models\AreaTeam::factory(25)->create();
//        \App\Models\Attendance::factory(25)->create();
//        \App\Models\AxisQuestion::factory(25)->create();
//        \App\Models\DailyReport::factory(25)->create();
//        \App\Models\DailyReportAssignUser::factory(25)->create();
//        \App\Models\GeneralReport::factory(25)->create();
//        \App\Models\NoticeType::factory(25)->create();
//        \App\Models\Notice::factory(25)->create();
//        \App\Models\PolicyPrivacy::factory(25)->create();
//        \App\Models\QuestionAnswer::factory(25)->create();
//        \App\Models\Setting::factory(1)->create();
//        \App\Models\ViolationReport::factory(25)->create();
//        \App\Models\DailyAssignUserAnswer::factory(25)->create();

        //make for each user assign role

    }
}

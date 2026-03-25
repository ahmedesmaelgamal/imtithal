<?php

namespace Database\Factories;

use App\Models\DailyReportAssignUser;
use Faker\Factory as FakerFactory;
use App\Models\User;
use App\Models\Axis;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportAssignUserFactory extends Factory
{
    protected $model = DailyReportAssignUser::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'daily_report_id' => $faker->numberBetween(1, 10),

            'user_id' => $faker->numberBetween(1, 10),
            'deadline' => $this->faker->date('Y-m-d'),
            'status' => $this->faker->randomElement(['0', '1', '2', '3', '4']),
            'axis_id' => $faker->numberBetween(1, 10),
            'area_id' => $faker->numberBetween(1, 10),
            'leader_id' => $faker->numberBetween(1, 10),
        ];
    }
}

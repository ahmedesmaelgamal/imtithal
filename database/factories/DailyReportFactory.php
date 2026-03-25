<?php

namespace Database\Factories;

use App\Models\DailyReport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class DailyReportFactory extends Factory
{
    protected $model = DailyReport::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'axis_id' => $faker->numberBetween(1, 10),
            'monitor_type' => $faker->randomElement(['0', '1','2']),
            'side_type' => $faker->randomElement(['0', '1','2']),
            'deadline' => $faker->date('Y-m-d'),
        ];
    }
}

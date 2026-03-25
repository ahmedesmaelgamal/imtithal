<?php

namespace Database\Factories;

use App\Enum\ReportStatusEnum;
use App\Models\GeneralReport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class GeneralReportFactory extends Factory
{
    protected $model = GeneralReport::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'extra' => $faker->optional()->text,
            'leader_id' => $faker->numberBetween(1, 10),
            'admin_id' => $faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['0', '1', '2']),
        ];
    }
}

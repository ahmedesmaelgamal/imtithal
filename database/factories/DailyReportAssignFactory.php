<?php

namespace Database\Factories;

use App\Models\DailyReportAssign;
use App\Models\DailyReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportAssignFactory extends Factory
{
    protected $model = DailyReportAssign::class;

    public function definition(): array
    {
        return [
            'daily_report_id' => DailyReport::factory(),
            'deadline' => $this->faker->date('Y-m-d'),
        ];
    }
}

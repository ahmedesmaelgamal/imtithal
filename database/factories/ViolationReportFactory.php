<?php

namespace Database\Factories;

use App\Enum\ReportStatusEnum;
use App\Models\ViolationReport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ViolationReportFactory extends Factory
{
    protected $model = ViolationReport::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'reference_number' => $faker->unique()->numerify('VR-#####'),
            'violation_time' => $faker->time('H:i:s'),
            'violation_date' => $faker->date('Y-m-d'),
            'map_url' => $faker->url,
            'lat' => $faker->latitude,
            'long' => $faker->longitude,
            'plate_number' => $faker->regexify('[A-Z]{3}[0-9]{4}'),
            'plate_letter_ar' => $faker->randomLetter,
            'plate_letter_en' => $faker->randomLetter,
            'plate_image' => $faker->optional()->imageUrl(200, 200, 'transport'),
            'vehicle_type' => $faker->randomElement(['car', 'truck', 'motorcycle']),
            'violation_image' => $faker->optional()->imageUrl(400, 400, 'crime'),
            'violation_video' => $faker->optional()->url,
            'user_id' => $faker->numberBetween(1, 10),
            'admin_id' => $faker->numberBetween(1, 10),
            'user_type' => $faker->randomElement(['0', '1']),
            'status' => $this->faker->randomElement(['0', '1', '2']),
        ];
    }
}

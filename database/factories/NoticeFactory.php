<?php

namespace Database\Factories;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class NoticeFactory extends Factory
{
    protected $model = Notice::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'notice_type_id' => $faker->numberBetween(1, 10),
            'lat' => $faker->latitude,
            'long' => $faker->longitude,
            'description'=>$faker->paragraph,
            'notice_time' => $faker->time('H:i:s'),
            'notice_date' => $faker->date('Y-m-d'),
            'user_id' => $faker->numberBetween(1, 10),
            'status' => $faker->randomElement(['0', '1', '2']),
            'refuse_reason' => $faker->optional()->sentence,
            'refuse_notice' => $faker->optional()->sentence,
            'admin_id' => $faker->numberBetween(1, 10),
            'leader_id' => $faker->numberBetween(1, 10),
        ];
    }
}

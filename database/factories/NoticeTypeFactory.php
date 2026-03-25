<?php

namespace Database\Factories;

use App\Models\NoticeType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class NoticeTypeFactory extends Factory
{
    protected $model = NoticeType::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'name' => $faker->word,
            'priority' => $faker->randomElement(['suggest', 'low', 'mid', 'high']),
            'period' => $faker->randomElement(['none', 'after 24 hours', 'after 48 hours', 'live']),
//            'level' => $faker->randomElement(['لم يتم التصعيد', 'اذا لم يعالج', 'تصعيد مباشر']),
        ];
    }
}

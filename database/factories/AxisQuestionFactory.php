<?php

namespace Database\Factories;

use App\Models\AxisQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class AxisQuestionFactory extends Factory
{
    protected $model = AxisQuestion::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'question' => $faker->sentence,
            'axis_id' => $faker->numberBetween(1, 10),
            'answer_type' => $faker->randomElement(['0', '1', '2']),
            'require_file' => $faker->randomElement(['0', '1']),
            'order_number' => $faker->numberBetween(1, 100),
        ];
    }
}

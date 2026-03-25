<?php

namespace Database\Factories;

use App\Models\QuestionAnswer;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionAnswerFactory extends Factory
{
    protected $model = QuestionAnswer::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'axis_question_id' => $faker->numberBetween(1, 10),
            'answer' => $this->faker->sentence,
        ];
    }
}

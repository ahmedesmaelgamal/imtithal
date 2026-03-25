<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyAssignUserAnswer>
 */
class DailyAssignUserAnswerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'daily_report_assign_user_id' => $this->faker->numberBetween(1, 10),
            'axis_question_id' => $this->faker->numberBetween(1, 10),
            'answer' => $this->faker->sentence(),
            'question_answer_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['0', '1', '2']),
            'user_id' => $this->faker->numberBetween(1, 10),
            'refuse_reason' => $this->faker->optional()->sentence(),
            'refuse_notice' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

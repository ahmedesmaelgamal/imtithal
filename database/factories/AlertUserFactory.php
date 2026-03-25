<?php

namespace Database\Factories;

use App\Models\AlertUser;
use Faker\Factory as FakerFactory;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlertUserFactory extends Factory
{
    protected $model = AlertUser::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'user_id' => $faker->numberBetween(1, 10),
            'alert_id' => $faker->numberBetween(1, 10),
            'seen' => $this->faker->randomElement([0, 1]),
        ];
    }
}

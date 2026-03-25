<?php

namespace Database\Factories;

use App\Models\AlertLeader;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlertLeaderFactory extends Factory
{
    protected $model = AlertLeader::class;


    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'alert_id' => $faker->numberBetween(1, 10),
            'leader_id' => $faker->numberBetween(1, 10),
        ];
    }
}

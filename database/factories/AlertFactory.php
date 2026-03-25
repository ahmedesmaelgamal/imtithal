<?php

namespace Database\Factories;

use App\Models\Alert;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class AlertFactory extends Factory
{
    protected $model = Alert::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
            'type' => $faker->randomElement(['alert', 'notification', 'reminder']),
            'leader_id' => $faker->numberBetween(1, 10),
            'admin_id' => $faker->numberBetween(1, 10),
            'to' => $faker->randomElement(['0', '1', '2']),
            'priority' => $faker->randomElement(['low', 'mid', 'high']),
        ];
    }
}

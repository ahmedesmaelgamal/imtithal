<?php

namespace Database\Factories;

use App\Models\AreaTeam;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaTeamFactory extends Factory
{
    protected $model = AreaTeam::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');


        return [
            'type' => $this->faker->randomElement([0, 1]),
            'area_id' => $faker->numberBetween(1, 10),
            'user_id' => $faker->numberBetween(1, 10),
        ];
    }
}

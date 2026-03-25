<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class AreaFactory extends Factory
{
    protected $model = Area::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'name' => $faker->city,
            'axis_id' => $faker->numberBetween(1, 10),
        ];
    }
}

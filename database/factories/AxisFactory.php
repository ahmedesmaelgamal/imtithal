<?php

namespace Database\Factories;

use App\Models\Axis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class AxisFactory extends Factory
{
    protected $model = Axis::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');
        return [
            'name' => $faker->word,
        ];
    }
}

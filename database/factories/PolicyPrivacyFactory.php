<?php

namespace Database\Factories;

use App\Models\PolicyPrivacy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class PolicyPrivacyFactory extends Factory
{
    protected $model = PolicyPrivacy::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
            'type' => $this->faker->randomElement(['0', '1']),
        ];
    }
}

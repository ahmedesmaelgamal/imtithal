<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'full_name' => $faker->name,
            'national_id' => $faker->unique()->numerify('############'),
            'phone' => $faker->unique()->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'image' => $faker->imageUrl(200, 200, 'people'),
            'password' => Hash::make('password'),
            'otp' => null,
            'otp_expire' => null,
        ];
    }
}

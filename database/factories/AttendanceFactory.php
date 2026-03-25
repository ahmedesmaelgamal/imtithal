<?php

namespace Database\Factories;

use App\Models\Attendance;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        $checkin = $this->faker->dateTimeThisMonth();
        $checkout = (clone $checkin)->modify('+' . rand(1, 8) . ' hours');
        $faker = FakerFactory::create('ar_SA');

        return [

            'user_id' => $faker->numberBetween(1, 10),
            'checkin' => $checkin,
            'checkout' => $this->faker->boolean(80) ? $checkout : null,
            'checkin_lat' => $this->faker->latitude,
            'checkin_long' => $this->faker->longitude,
            'date' => $checkin->format('Y-m-d'),
            'checkout_lat' => $this->faker->boolean(80) ? $this->faker->latitude : null,
            'checkout_long' => $this->faker->boolean(80) ? $this->faker->longitude : null,
        ];
    }
}

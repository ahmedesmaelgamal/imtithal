<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'checkin_date' => $this->faker->time('H:i:s'),
            'checkout_date' => $this->faker->time('H:i:s'),
            'checkin_max_date' => $this->faker->time('H:i:s'),
            'checkout_max_date' => $this->faker->time('H:i:s'),
            'north' => $this->faker->latitude,
            'south' => $this->faker->latitude,
            'east' => $this->faker->latitude,
            'west' => $this->faker->latitude,
            'location_url' => 'https://www.google.com/maps/place/Madinah+Saudi+Arabia/@24.4712955,39.4527436,11z/data=!3m1!4b1!4m6!3m5!1s0x15bdbe5197d220d5:0x2e54514fea3b08d9!8m2!3d24.4672132!4d39.6024496!16zL20vMDk0dmY?entry=ttu&g_ep=EgoyMDI1MDIxNy4wIKXMDSoASAFQAw%3D%3D',
        ];
    }
}

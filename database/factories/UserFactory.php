<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;
use Spatie\Permission\Models\Role;

// Import Spatie Role Model

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'national_id' => $this->faker->unique()->numerify('############'),
            'phone' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'image' => $this->faker->imageUrl(200, 200, 'people'),
            'fcm_token' => $this->faker->uuid,
            'jwt_token' => $this->faker->uuid,
            'password' => Hash::make('123456789'),
            'otp' => null,
            'otp_expire' => null,
            'status' => $this->faker->randomElement([0, 1]),
            'delete_reason' => $this->faker->optional()->sentence,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Fetch roles only from the 'web' guard
            $role = Role::where('guard_name', 'user')->inRandomOrder()->first();
            if ($role) {
                $user->assignRole($role->name);
            }
        });
    }
}

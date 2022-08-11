<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password(),
            'phone' => $this->faker->phoneNumber(),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'is_admin' => false,
        ];
    }
}

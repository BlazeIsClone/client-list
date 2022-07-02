<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();

        return [
            'email'             => $this->faker->unique()->safeEmail,
            'title'             => $this->faker->title(),
            'first_name'        => $firstName,
            'last_name'         => $lastName,
            'avatar'            => "https://avatars.dicebear.com/api/initials/{$firstName}-{$lastName}.png",
            'primary_phone'     => $this->faker->phoneNumber(),
            'secondary_phone'   => $this->faker->phoneNumber(),
            'job_title'         => $this->faker->jobTitle(),
            'timezone'          => $this->faker->country(),
            'company_id'        => Company::factory(),
        ];
    }
}

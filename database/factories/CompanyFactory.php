<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->company();

        return [
            'name' => $name,
            'email' => $this->faker->companyEmail(),
            'industry' => $this->faker->jobTitle(),
            'domain' => $this->faker->unique()->domainName(),
            'primary_phone' => $this->faker->phoneNumber(),
            'secondary_phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(5),
            'logo' => "https://avatars.dicebear.com/api/jdenticon/{$name}.png",
            'user_id' => User::factory(),
        ];
    }
}

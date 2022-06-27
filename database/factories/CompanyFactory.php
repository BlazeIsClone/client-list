<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(),
            'email' => $this->faker->companyEmail(),
            'industry' => $this->faker->jobTitle(),
            'domain' => $this->faker->unique()->domainName(),
            'primary_phone' => $this->faker->phoneNumber(),
            'secondary_phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(5),
            'logo' => $this->faker->imageUrl(
                width: 400,
                height: 400,
                category: 'comany',
                word: 'logo'
            ),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'contact_first_name' => $this->faker->firstName,
            'contact_last_name'  => $this->faker->lastName,
            'contact_email'      => $this->faker->unique()->safeEmail,
            'contact_phone'      => $this->faker->phoneNumber,
        ];
    }
}

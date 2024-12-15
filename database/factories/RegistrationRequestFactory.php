<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'phelNamespace' => fake()->regexify('[A-Za-z]{1}[-0-9A-Z\\a-z]{0,254}'),
            'name' => fake()->regexify("[A-Za-z]{1}[-0-9A-Za-z]{0,254}"),
            'symbol_type' => fake()->randomElement(['special-form', 'macro', 'function']),
            'description' => fake()->text(16000),
            'status' => fake()->randomElement(['Requested', 'Reviewed', 'Registered']),
        ];
    }
}

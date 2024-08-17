<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsageExampleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'example' => fake()->text(65535),
        ];
    }
}

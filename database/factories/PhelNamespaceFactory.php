<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhelNamespaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'namespace' => fake()->regexify('[A-Za-z]{1,1}[-0-9A-Z\\a-z]{0,254}'),
        ];
    }
}

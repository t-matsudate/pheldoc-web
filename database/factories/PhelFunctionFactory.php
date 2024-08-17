<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhelFunctionFactory extends Factory
{
    public function definition(): array
    {
        $basePattern = '!$%&*+,-./;<=>?@A-Z[\\]^_`a-z|~';
        
        return [
            'name' => fake()->regexify("[$basePattern]{1,1}[0-9$basePattern]{0,254}"),
            'symbol_type' => fake()->randomElement(['special-form', 'macro', 'function']),
            'description' => fake()->text('65535'),
        ];
    }
}

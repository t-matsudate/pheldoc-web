<?php

namespace Tests\Feature\View;

use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function test_exact_items_count(): void
    {
        $basePattern = '!$%*+,-./;<=>?@A-Z[\\]^_`a-z|~';
        $count = fake()->randomNumber(1, false);
        $name = fake()->regexify("[$basePattern]{1,1}[0-9$basePattern]{0,254}");
        $functions = PhelFunction::factory()
            ->for(PhelNamespace::factory())
            ->count($count)
            ->create(['name' => $name]);
        
        $contents = $this->view('search', [
            'name' => $name,
            'functions' => $functions
        ]);

        $contents->assertSee($count . '&nbsp;functions&nbsp;found.', false);

        foreach ($functions as $function) {
            $contents->assertSee('id="' . $function->id . '"', false);
        }
    }
}

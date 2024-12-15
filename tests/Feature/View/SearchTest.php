<?php

namespace Tests\Feature\View;

use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testExactItemsCount(): void
    {
        $count = fake()->randomNumber(1, false);
        $name = fake()->regexify("[A-Za-z]{1}[-0-9A-Za-z]{0,254}");
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

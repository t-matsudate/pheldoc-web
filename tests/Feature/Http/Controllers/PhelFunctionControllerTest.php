<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhelFunctionControllerTest extends TestCase
{
    public function test_be_accessible(): void
    {
        $function = PhelFunction::factory()
            ->for(PhelNamespace::factory())
            ->create();
        $response = $this->get(route('function.show', ['namespace' => $function->phelNamespace->namespace, 'name' => $function->name]));
        $response->assertOk();
    }
}

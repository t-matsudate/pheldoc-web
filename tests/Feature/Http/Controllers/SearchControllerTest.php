<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    
    public function testRandomSearchingKeyword(): void
    {
        $response = $this->get(route('search.index', ['q' => fake()->text(255)]));
        $response->assertOk();
    }
}

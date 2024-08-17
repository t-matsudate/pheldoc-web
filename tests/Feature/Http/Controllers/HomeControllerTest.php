<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_index_page_is_visible(): void
    {
        $response = $this->get(route('home.index'));

        $response->assertStatus(200);
    }
}

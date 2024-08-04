<?php

namespace Tests\Feature\View\Home;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_view_exists(): void
    {
        $contents = $this->view('home.index', [
        ]);

        $contents->assertSee('');
    }
}

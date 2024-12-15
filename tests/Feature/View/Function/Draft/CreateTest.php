<?php

namespace Tests\Feature\View\Function\Draft;

use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class CreateTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $contents = $this->view('function.draft.create', [
            'errors' => new ViewErrorBag
        ]);

        $contents->assertSee('');
    }
}

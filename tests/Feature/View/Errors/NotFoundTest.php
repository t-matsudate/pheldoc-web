<?php

namespace Tests\Feature\View\Errors;

use Tests\TestCase;

class NotFoundTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $contents = $this->view('errors.404', [
        ]);

        $contents->assertSee('');
    }
}

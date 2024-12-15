<?php

namespace Tests\Feature\View\Errors;

use Tests\TestCase;

class ForbiddenTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('errors.403', [
            //
        ]);

        $contents->assertSee('');
    }
}

<?php

namespace Tests\Feature\View\Errors;

use Tests\TestCase;

class InternalServerErrorTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $contents = $this->view('errors.500', [
        ]);

        $contents->assertSee('');
    }
}

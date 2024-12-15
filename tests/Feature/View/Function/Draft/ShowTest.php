<?php

namespace Tests\Feature\View\Function\Draft;

use App\Models\RegistrationRequest;
use App\Models\User;
use Tests\TestCase;

class ShowTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $contents = $this->view('function.draft.show', [
            'draft' => RegistrationRequest::factory()
                ->for(User::factory())
                ->create(),
        ]);

        $contents->assertSee('');
    }
}

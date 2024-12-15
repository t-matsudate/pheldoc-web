<?php

namespace Tests\Feature\View\Function\Draft;

use App\Models\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class EditTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $contents = $this->view('function.draft.edit', [
            'draft' => RegistrationRequest::factory()
                ->for(User::factory())
                ->create(),
            'errors' => new ViewErrorBag
        ]);

        $contents->assertSee('');
    }
}

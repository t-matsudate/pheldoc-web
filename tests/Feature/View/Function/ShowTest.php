<?php

namespace Tests\Feature\View\Function;

use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use App\Models\UsageExample;
use App\Models\User;
use Tests\TestCase;

class ShowTest extends TestCase
{
    public function test_exact_items_count(): void
    {
        $count = fake()->randomNumber(2);
        $function = PhelFunction::factory()
            ->for(PhelNamespace::factory())
            ->create();
        $examples = UsageExample::factory()
            ->for($function)
            ->for(User::factory())
            ->count($count)
            ->create();
        $contents = $this->view('function.show', [
            'function' => $function
        ]);

        $contents->assertSee($function->phelNamespace->namespace . '/' . $function->name);
        $contents->assertSee($count . '&nbsp;examples.', false);

        foreach ($examples as $example) {
            $contents->assertSee('id="' . $example->id . '"', false);
        }
    }
}

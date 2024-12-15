<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use App\Models\RegistrationRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PhelFunctionControllerTest extends TestCase
{
    public function testShowFunction(): void
    {
        $function = PhelFunction::factory()
            ->for(PhelNamespace::factory())
            ->create();
        $response = $this->get(route('function.show', ['namespace' => $function->phelNamespace->namespace, 'name' => $function->name]));
        $response->assertOk();
    }

    public function testShowEncodedName(): void
    {
        $function = PhelFunction::factory()
            ->for(PhelNamespace::factory())
            ->create(['name' => fake()->randomElement(['!', '%', '*', '+', '-', '/', '::', '<', '=', '>', '?'])]);
        $response = $this->get(route('function.show', ['namespace' => $function->phelNamespace->namespace, 'name' => $function->name]));
        $response->assertOk();
    }
    
    public function testCreateDraft(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $response = $this->actingAs($user)->get(route('function.draft.create'));
        $response->assertOk();
    }

    public function testStoreDraft(): void
    {
        $user = User::factory()->create();
        $draft = RegistrationRequest::factory()
            ->for($user)
            ->make();
        $response = $this->actingAs($user)->post(route('function.draft.store'), [
            'phelNamespace' => $draft->phelNamespace,
            'name' => $draft->name,
            'symbol_type' => $draft->symbol_type,
            'description' => $draft->desciption
        ]);
        $this->assertAuthenticated();
        $response->assertFound();
    }

    public function testShowDraft(): void
    {
        $draft = RegistrationRequest::factory()
            ->for(User::factory())
            ->create();
        $response = $this->get(route('function.draft.show', ['id' => $draft->id]));
        $response->assertOk();
    }

    public function testEditDraftWithDraftOwner(): void
    {
        $user = User::factory()->create();
        $draft = RegistrationRequest::factory()
            ->for($user)
            ->create();
        $response = $this->actingAs($user)->get(route('function.draft.edit', ['id' => $draft->id]));
        $response->assertOk();
    }

    public function testEditDraftWithNotDraftOwner(): void
    {
        $draft = RegistrationRequest::factory()
            ->for(User::factory())
            ->create();
        $otherUser = User::factory()->create();
        $response = $this->actingAs($otherUser)->get(route('function.draft.edit', ['id' => $draft->id]));
        $response->assertForbidden();
    }

    public function testUpdateDraftWithDraftOwner(): void
    {
        $user = User::factory()->create();
        $draft = RegistrationRequest::factory()
            ->for($user)
            ->create();
        $response = $this->actingAs($user)->post(route('function.draft.update', ['id' => $draft->id]), [
            'phelNamespace' => $draft->phelNamespace,
            'name' => $draft->name,
            'symbol_type' => $draft->symbol_type,
            'description' => fake()->text(16000)
        ]);
        $this->assertAuthenticated();
        $response->assertFound();
    }

    public function testUpdateDraftWithNotDraftOwner(): void
    {
        $draft = RegistrationRequest::factory()
            ->for(User::factory())
            ->create();
        $otherUser = User::factory()->create();
        $response = $this->actingAs($otherUser)->post(route('function.draft.update', ['id' => $draft->id]), [
            'phelNamespace' => $draft->phelNamespace,
            'name' => $draft->name,
            'symbol_type' => $draft->symbol_type,
            'description' => fake()->text(16000)
        ]);
        $response->assertForbidden();
    }

    // TODO: Runs tests
}

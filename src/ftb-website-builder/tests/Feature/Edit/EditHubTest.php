<?php

namespace Tests\Feature\Edit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditHubTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_hub_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('edit'));

        $response->assertOk();
    }
}

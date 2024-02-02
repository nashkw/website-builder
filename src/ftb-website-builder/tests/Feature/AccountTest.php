<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_page_is_displayed(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/account');

        $response->assertOk();
    }

    public function test_account_information_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->patch('/account', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/account');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
    }

    public function test_subdomain_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();
        $newSubdomain = fake()->domainWord;

        $response = $this
            ->actingAs($user)
            ->post('/account', [
                'subdomain' => $newSubdomain,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/account');

        $user->refresh();

        $this->assertSame($newSubdomain, $user->property->website->subdomain);
    }

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/account')
            ->put('/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/account');

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/account')
            ->put('/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrors('current_password')
            ->assertRedirect('/account');
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->delete('/account', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->from('/account')
            ->delete('/account', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrors('password')
            ->assertRedirect('/account');

        $this->assertNotNull($user->fresh());
    }
}

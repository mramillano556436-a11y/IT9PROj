<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_is_redirected_to_customer_dashboard_after_login(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
            'status' => 'active',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('customer.dashboard'));
    }

    public function test_admin_is_redirected_to_admin_dashboard_after_login(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_customer_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertForbidden();
    }

    public function test_admin_cannot_access_customer_routes(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->get('/customer/dashboard');

        $response->assertForbidden();
    }

    public function test_inactive_user_cannot_stay_logged_in(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
            'status' => 'inactive',
            'password' => 'password',
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}

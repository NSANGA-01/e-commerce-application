<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_manage_products(): void
    {
        $this->get(route('admin.products.index'))
            ->assertRedirect(route('admin.login'));

        $this->post(route('admin.products.store'), [
            'name' => 'Unauthorized product',
            'description' => 'Should not be created',
            'price' => 100,
            'stock' => 5,
        ])->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_manage_products(): void
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'display_name' => 'Administrator',
            'description' => 'System administrator',
        ]);
        $admin = User::factory()->create();
        $admin->addRole($adminRole);

        $this->actingAs($admin)
            ->get(route('admin.products.index'))
            ->assertOk();

        $this->actingAs($admin)
            ->post(route('admin.products.store'), [
                'name' => 'Authorized product',
                'description' => 'Created by an administrator',
                'price' => 100,
                'stock' => 5,
                'is_active' => true,
            ])
            ->assertRedirect(route('admin.products.index'));
    }

    public function test_admin_can_login_and_logout(): void
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'display_name' => 'Administrator',
            'description' => 'System administrator',
        ]);
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
        $admin->addRole($adminRole);

        $this->post(route('admin.login.store'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ])
            ->assertRedirect(route('admin.products.index'));

        $this->assertAuthenticatedAs($admin);

        $this->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
    }

    public function test_non_admin_account_cannot_login_as_admin(): void
    {
        User::factory()->create([
            'email' => 'customer@example.com',
            'password' => 'password123',
        ]);

        $this->post(route('admin.login.store'), [
            'email' => 'customer@example.com',
            'password' => 'password123',
        ])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}

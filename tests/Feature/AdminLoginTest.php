<?php

namespace Tests\Feature;

use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_with_the_seeded_credentials(): void
    {
        $this->seed(AdminUserSeeder::class);

        $response = $this->post(route('login.authenticate'), [
            'email' => 'adminsolusikoneksi@gmail.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_admin_pages_require_authentication(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_can_log_out(): void
    {
        $this->seed(AdminUserSeeder::class);
        $this->post(route('login.authenticate'), [
            'email' => 'adminsolusikoneksi@gmail.com',
            'password' => 'admin123',
        ]);

        $this->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}

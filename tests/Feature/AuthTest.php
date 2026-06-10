<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_can_store_user_and_login(): void
    {
        $response = $this->post('/register', [
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');

        $this->assertDatabaseHas('users', [
            'name' => '山田 太郎',
            'email' => 'test@example.com',
        ]);

        $this->assertAuthenticated();
    }

    public function test_login_can_redirect_to_admin(): void
    {
        User::create([
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');

        $this->assertAuthenticated();
    }

    public function test_guest_cannot_access_admin(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_logout_can_logout_user(): void
    {
        User::create([
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();

        $this->post('/logout');

        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }
}
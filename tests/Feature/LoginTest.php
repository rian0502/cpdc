<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_login_with_invalid_input()
    {
        // Jalur Independen 1: Input tidak valid
        $response = $this->post('/login', [
            'email' => '', // Email kosong
            'password' => '', // Password kosong
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
        $response->assertRedirect(); // Pastikan ada redirect (biasanya kembali ke login)
    }

    public function test_login_with_wrong_credentials()
    {
        // Jalur Independen 2: Otentikasi gagal (kredensial salah)
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('correctpassword'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword', // Password salah
        ]);

        $response->assertSessionHasErrors(['status']);
        $response->assertRedirect(); // Pastikan ada redirect
    }

    public function test_login_with_correct_credentials()
    {
        // Jalur Independen 3: Otentikasi berhasil (kredensial benar)
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('correctpassword'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'correctpassword', // Password benar
        ]);

        $response->assertRedirect('/dashboard'); // Asumsikan '/dashboard' adalah intended url setelah login
        $this->assertAuthenticatedAs(User::first()); // Pastikan user telah terotentikasi
    }
}

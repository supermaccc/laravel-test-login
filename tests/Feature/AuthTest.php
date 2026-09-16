<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated user visiting root is redirected to login', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('login'));
});

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('เข้าสู่ระบบ');
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'password123',
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'password123',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard'));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'password123',
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
});

test('authenticated user cannot view login page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/login');

    $response->assertRedirect(route('dashboard'));
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect(route('login'));
});

test('unauthenticated users cannot access protected routes', function () {
    $this->get('/dashboard')->assertRedirect(route('login'));
    $this->get('/users')->assertRedirect(route('login'));
    $this->get('/users/create')->assertRedirect(route('login'));
    $this->get('/profile/edit')->assertRedirect(route('login'));
});

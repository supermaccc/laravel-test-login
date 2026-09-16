<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('profile edit screen can be rendered', function () {
    $user = User::factory()->create([
        'name' => 'Profile Owner',
        'email' => 'owner@example.com',
    ]);

    $response = $this->actingAs($user)->get('/profile/edit');

    $response->assertStatus(200);
    $response->assertSee('แก้ไขโปรไฟล์ส่วนตัว');
    $response->assertSee('Profile Owner');
    $response->assertSee('owner@example.com');
});

test('user can update their basic profile information', function () {
    $user = User::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com',
    ]);

    $response = $this->actingAs($user)->put('/profile', [
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);

    $response->assertRedirect(route('profile.edit'));
    $response->assertSessionHas('success');

    $user->refresh();
    expect($user->name)->toBe('New Name');
    expect($user->email)->toBe('new@example.com');
});

test('user can update their password with valid current password', function () {
    $user = User::factory()->create([
        'password' => 'oldpassword123',
    ]);

    $response = $this->actingAs($user)->put('/profile', [
        'name' => $user->name,
        'email' => $user->email,
        'current_password' => 'oldpassword123',
        'password' => 'newpassword456',
        'password_confirmation' => 'newpassword456',
    ]);

    $response->assertRedirect(route('profile.edit'));
    $response->assertSessionHas('success');

    $user->refresh();
    expect(Hash::check('newpassword456', $user->password))->toBeTrue();
});

test('user cannot update password with invalid current password', function () {
    $user = User::factory()->create([
        'password' => 'oldpassword123',
    ]);

    $response = $this->actingAs($user)->put('/profile', [
        'name' => $user->name,
        'email' => $user->email,
        'current_password' => 'wrongpassword',
        'password' => 'newpassword456',
        'password_confirmation' => 'newpassword456',
    ]);

    $response->assertSessionHasErrors('current_password');

    $user->refresh();
    expect(Hash::check('oldpassword123', $user->password))->toBeTrue();
});

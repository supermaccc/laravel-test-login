<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('authenticated user can view users index page', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create(['name' => 'Somchai Jaidee']);

    $response = $this->actingAs($user)->get('/users');

    $response->assertStatus(200);
    $response->assertSee('จัดการผู้ใช้งาน');
    $response->assertSee('Somchai Jaidee');
});

test('user search works correctly', function () {
    $user = User::factory()->create();
    $userA = User::factory()->create(['name' => 'Alice SpecialName', 'email' => 'alice@test.com']);
    $userB = User::factory()->create(['name' => 'Bob OtherName', 'email' => 'bob@test.com']);

    $response = $this->actingAs($user)->get('/users?search=Alice');

    $response->assertStatus(200);
    $response->assertSee('Alice SpecialName');
    $response->assertDontSee('Bob OtherName');
});

test('admin can view create user screen', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->get('/users/create');

    $response->assertStatus(200);
    $response->assertSee('เพิ่มผู้ใช้งานใหม่');
});

test('regular user cannot access create user screen', function () {
    $regularUser = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($regularUser)->get('/users/create');

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('error');
});

test('admin can create new user with valid data', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->post('/users', [
        'name' => 'New Staff',
        'email' => 'staff@example.com',
        'role' => 'user',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'name' => 'New Staff',
        'email' => 'staff@example.com',
        'role' => 'user',
    ]);

    $createdUser = User::where('email', 'staff@example.com')->first();
    expect(Hash::check('secret123', $createdUser->password))->toBeTrue();
});

test('regular user cannot create user via post', function () {
    $regularUser = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($regularUser)->post('/users', [
        'name' => 'Hacker User',
        'email' => 'hacker@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('error');
    $this->assertDatabaseMissing('users', ['email' => 'hacker@example.com']);
});

test('cannot create user with duplicate email', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->create(['email' => 'existing@example.com']);

    $response = $this->actingAs($admin)->post('/users', [
        'name' => 'Duplicate Email User',
        'email' => 'existing@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ]);

    $response->assertSessionHasErrors('email');
});

test('admin can view edit screen of any user', function () {
    $admin = User::factory()->admin()->create();
    $targetUser = User::factory()->create(['name' => 'Target Edit']);

    $response = $this->actingAs($admin)->get("/users/{$targetUser->id}/edit");

    $response->assertStatus(200);
    $response->assertSee('แก้ไขข้อมูลผู้ใช้งาน');
    $response->assertSee('Target Edit');
});

test('regular user can view edit screen of themselves', function () {
    $regularUser = User::factory()->create(['role' => 'user', 'name' => 'My Self']);

    $response = $this->actingAs($regularUser)->get("/users/{$regularUser->id}/edit");

    $response->assertStatus(200);
    $response->assertSee('แก้ไขข้อมูลผู้ใช้งาน');
    $response->assertSee('My Self');
});

test('regular user CANNOT view edit screen of another user', function () {
    $regularUser = User::factory()->create(['role' => 'user']);
    $otherUser = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($regularUser)->get("/users/{$otherUser->id}/edit");

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('error');
});

test('admin can update other users', function () {
    $admin = User::factory()->admin()->create();
    $targetUser = User::factory()->create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
    ]);

    $response = $this->actingAs($admin)->put("/users/{$targetUser->id}", [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id' => $targetUser->id,
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ]);
});

test('regular user can update their own information', function () {
    $regularUser = User::factory()->create([
        'role' => 'user',
        'name' => 'Old Self',
        'email' => 'oldself@example.com',
    ]);

    $response = $this->actingAs($regularUser)->put("/users/{$regularUser->id}", [
        'name' => 'New Self Name',
        'email' => 'newself@example.com',
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id' => $regularUser->id,
        'name' => 'New Self Name',
        'email' => 'newself@example.com',
    ]);
});

test('regular user CANNOT update another user', function () {
    $regularUser = User::factory()->create(['role' => 'user']);
    $targetUser = User::factory()->create(['role' => 'user', 'name' => 'Original Name']);

    $response = $this->actingAs($regularUser)->put("/users/{$targetUser->id}", [
        'name' => 'Hacked Name',
        'email' => 'hacked@example.com',
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('error');

    $this->assertDatabaseHas('users', [
        'id' => $targetUser->id,
        'name' => 'Original Name',
    ]);
});

test('admin can delete another user', function () {
    $admin = User::factory()->admin()->create();
    $targetUser = User::factory()->create();

    $response = $this->actingAs($admin)->delete("/users/{$targetUser->id}");

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('users', [
        'id' => $targetUser->id,
    ]);
});

test('regular user CANNOT delete another user', function () {
    $regularUser = User::factory()->create(['role' => 'user']);
    $targetUser = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($regularUser)->delete("/users/{$targetUser->id}");

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('error');

    $this->assertDatabaseHas('users', [
        'id' => $targetUser->id,
    ]);
});

test('admin cannot delete themselves', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->delete("/users/{$admin->id}");

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('error');

    $this->assertDatabaseHas('users', [
        'id' => $admin->id,
    ]);
});

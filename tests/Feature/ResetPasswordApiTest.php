<?php

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

beforeEach(function () {
  $this->department = Department::factory()->create();
  $this->role = Role::factory()->create();
});

it('resets the password when the token and email are valid', function () {
  $user = User::factory()->create([
    'email' => 'reset@example.com',
    'department_id' => $this->department->id,
    'role_id' => $this->role->id,
  ]);

  $token = Password::createToken($user);

  $response = $this->withQueryParameters([
    'email' => $user->email,
    'token' => $token,
  ])->postJson('/api/reset_password', [
    'newPassword' => 'NewPassword123!',
    'confirmPassword' => 'NewPassword123!',
  ]);

  $response->assertStatus(200)
    ->assertJson([
      'message' => 'Password reset successfully',
    ]);

  $user->refresh();
  expect(Hash::check('NewPassword123!', $user->password))->toBeTrue();
});

it('fails when the reset token is invalid', function () {
  $user = User::factory()->create([
    'email' => 'invalid-token@example.com',
    'department_id' => $this->department->id,
    'role_id' => $this->role->id,
    'email' => $user->email,
    'token' => 'invalid-token',
  ])->postJson('/api/reset_password', [
    'newPassword' => 'NewPassword123!',
    'confirmPassword' => 'NewPassword123!',
  ]);

  $response->assertStatus(422);
});

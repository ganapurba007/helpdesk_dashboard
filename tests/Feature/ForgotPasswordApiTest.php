<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

it('sends a reset link when the email exists', function () {
  Notification::fake();

  $user = User::factory()->create([
    'email' => 'user@example.com',
  ]);

  $response = $this->postJson('/api/forgot_password', [
    'email' => $user->email,
  ]);

  $response->assertStatus(200)
    ->assertJson([
      'message' => 'Password reset link sent successfully',
    ]);

  Notification::assertSentTo($user, ResetPassword::class);
});

it('fails validation when the email is invalid or not registered', function () {
  Notification::fake();

  $response = $this->postJson('/api/forgot_password', [
    'email' => 'not-an-email',
  ]);

  $response->assertStatus(422);

  Notification::assertNothingSent();
});

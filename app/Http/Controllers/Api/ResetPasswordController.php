<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
  public function __invoke(Request $request)
  {
    $request->merge([
      'email' => $request->query('email', $request->input('email')),
      'token' => $request->query('token', $request->input('token')),
      'password' => $request->input('password', $request->input('newPassword')),
      'password_confirmation' => $request->input('password_confirmation', $request->input('confirmPassword')),
    ]);

    $request->validate([
      'email' => ['required', 'email', 'exists:users,email'],
      'token' => ['required', 'string'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user) use ($request) {
        $user->forceFill([
          'password' => Hash::make($request->password),
          'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));
      }
    );

    if ($status !== Password::PASSWORD_RESET) {
      return response()->json([
        'message' => __($status),
      ], 422);
    }

    return response()->json([
      'message' => 'Password reset successfully',
    ], 200);
  }
}

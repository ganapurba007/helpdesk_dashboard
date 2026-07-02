<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $credential = $request->validated();

        if (!auth()->attempt($credential)) {
            return response()->json([
                'message' => 'Invalid email or password',
                'errors' => ['credentials' => ['The provided credentials are incorrect.']]
            ], 401);
        }

        // Revoke existing tokens for security
        $user = auth()->user();
        $user->tokens()->delete();

        // Create new token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'user' => new UserResource($user->load('role', 'department')),
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }
}

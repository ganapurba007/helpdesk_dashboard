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
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token
            ]
        ], 200);
    }
}

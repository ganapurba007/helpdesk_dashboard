<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Cache role query (cache for 24 hours)
        $roleId = Cache::remember('employee_role_id', 86400, fn () =>
        Role::where('role_name', 'staff')->firstOrFail()->id);

        // Create user with validated data
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'department_id' => $validated['department_id'],
            'password' => Hash::make($validated['password']), // Hash password
            'role_id' => $roleId,
            'email_verified_at' => now(), // Auto-verify on registration
        ]);

        // Create authentication token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'data' => [
                'user' => new UserResource($user->load('role', 'department')),
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 201);
    }
}

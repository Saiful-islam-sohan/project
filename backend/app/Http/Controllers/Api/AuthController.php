<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Exception;
class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('User registered successfully', ['email' => $validated['email']]);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);

        } catch (Exception $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                Log::warning('Invalid login attempt', ['email' => $validated['email']]);
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('User logged in successfully', ['email' => $validated['email']]);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

        } catch (Exception $e) {
            Log::error('Login failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Login failed'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            Log::info('User logged out successfully', ['user_id' => $request->user()->id]);

            return response()->json(['message' => 'Logged out successfully']);

        } catch (Exception $e) {
            Log::error('Logout failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Logout failed'], 500);
        }
    }
}

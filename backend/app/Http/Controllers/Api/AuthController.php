<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            Log::info('Starting user registration.');

           
            $validatedData = $request->validated();

           
            Log::info('Validated Data:', $validatedData);

           
            if (User::where('email', $validatedData['email'])->exists()) {
                return response()->json(['message' => 'Email is already registered.'], 409);
            }

            
            $validatedData['password'] = Hash::make($validatedData['password']);

            
            $user = User::create($validatedData);

            if (!$user) {
                Log::error('User creation failed.');
                return response()->json(['message' => 'User registration failed'], 500);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('User registered successfully.', ['user_id' => $user->id]);

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Registration error.', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'An error occurred during registration. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            // $validated = $request->validated();

            // $user = User::where('email', $validated['email'])->first();

            // if (!$user || !Hash::check($validated['password'], $user->password)) {
            //     Log::warning('Invalid login attempt', ['email' => $validated['email']]);
            //     return response()->json(['message' => 'Invalid credentials'], 401);
            // }

            // $token = $user->createToken('auth_token')->plainTextToken;

            // Log::info('User logged in successfully', ['email' => $validated['email']]);

            // return response()->json([
            //     'access_token' => $token,
            //     'token_type' => 'Bearer',
            // ]);

            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
        
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => strtolower($user->getRoleNames()->first()),// Retrieve the user's role
                    ],
                ]);
            }

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

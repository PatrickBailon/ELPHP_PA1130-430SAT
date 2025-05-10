<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'users_email' => 'required|email',
            'users_password' => 'required'
        ]);

        $user = User::where('users_email', $request->users_email)->first();

        if (! $user || ! Hash::check($request->users_password, $user->users_password)) {
            throw ValidationException::withMessages([
                'users_email' => ['The provided credentials are incorrect.']
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function signup(Request $request)
    {
        $request->validate([
            'users_name' => 'required|string|max:255',
            'users_email' => 'required|email|unique:users,users_email',
            'users_password' => 'required|string|min:6',
            'role' => 'required|in:admin,owner,renter'
        ]);

        $user = User::create([
            'users_name' => $request->users_name,
            'users_email' => $request->users_email,
            'users_password' => Hash::make($request->users_password),
            'role' => $request->role,
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}

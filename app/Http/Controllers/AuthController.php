<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use 
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string|unique:users',
            'password' => 'required|min:6',
            'address'  => 'nullable|string',
            'role'     => 'nullable|string|in:user,candidate,employer'
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'address'  => $data['address'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => $data['role'] ?? 'user'
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Registered successfully',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

   

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string'
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password'  => $request->password
        ];

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $user = User::where($loginField, $request->login)->first();

        return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => $user
        ], 200);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logged out']);
    }

    public function refresh()
    {
        $token = JWTAuth::refresh();

        return response()->json(['token' => $token]);
    }

    public function profile()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json($user);
    }
}

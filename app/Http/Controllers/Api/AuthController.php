<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'phone' => $fields['phone'],
        ]);

        //$token = $user->createToken('apiendpointtokenapp')->plainTextToken;

        $response = [
            'user' => $user,
            'message' => 'User created successfully'
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'logged out'
        ];

        return response($response, 200);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (is_null($user) || !Hash::check($fields['password'], $user->password))
        {
            return response([
                'message' => 'Wrong credentials'
            ], 401);
        }

        $token = $user->createToken('apiendpointtokenapp')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function profile()
    {
        $user = User::find(Auth::id());

        $response = [
            'user' => $user
        ];

        return response($response, 200);
    }
}

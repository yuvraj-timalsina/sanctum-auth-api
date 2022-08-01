<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|string'
        ]);

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('apiToken')->plainTextToken;
            return response()->json([
                'success' => true,
                'token' => $token
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false,
            'msg' => 'Unauthorized!'
        ], Response::HTTP_UNAUTHORIZED);

    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'msg' => 'Logged Out!'
        ];
    }
}

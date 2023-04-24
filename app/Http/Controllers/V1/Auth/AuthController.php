<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        // Check email
        $user = User::where('email', $request['email'])->first();
        // Check password
        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'email or password invalide'
            ], 401);
        }
        $token = $user->createToken($user->email)->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function logout(Request $request) {

        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}

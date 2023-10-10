<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest)
    {    
        if (Auth::attempt($loginRequest->only(['email', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken('teste')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json([
            'error' => 'Invalid credentials.'
        ], 401);
    }
}

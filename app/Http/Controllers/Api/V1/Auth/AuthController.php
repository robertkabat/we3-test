<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\Login;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login(Login $request): JsonResponse
    {
        if (!Auth::attempt($request->all())) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        return response()->json([
            'token' => $request->user()->createToken('authToken')->plainTextToken,
        ]);
    }
}

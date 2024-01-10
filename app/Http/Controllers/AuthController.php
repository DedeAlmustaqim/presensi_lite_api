<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function api_login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            // $unitData = $user->unit;
            // $user = User::with('unit')->find($user->id);
            $token = $user->createToken('authToken')->plainTextToken;
            $user['token'] = $token;
            
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'data' => [
                "message" => 'Wrong email or password'
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $token = $user->createToken('authToken')->plainTextToken;
    
        return response()->json(['token' => $token], 200);
    }
}

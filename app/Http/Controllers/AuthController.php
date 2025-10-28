<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        //$credentials = $request->only('email', 'password');

        if (auth()->attempt($request->only(['email', 'password']))) {
            //$user = auth()->user();
            //$token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'name' => $request->user()->name,
                //'token_type' => 'Bearer',
                'token' => $request->user()->createToken('TOKEN')->plainTextToken,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Credenciales incorrectas'
        ]);
    }
}

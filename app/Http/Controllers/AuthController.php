<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
		$attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|'
        ]);

        if (!Auth::attempt($attr)) {
            return ;
        }

        return [
            'token' => $request -> user() -> createToken('API Token') -> plainTextToken
        ];
    }

    public function logout(Request $request) {
		$token = $request -> user() -> currentAccessToken();
		$token -> where("id", $token -> id) -> delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}

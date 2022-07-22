<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
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
			return [];
		}

		$datos = Usuario::where("email", $request -> email)
			-> select(["nombre", "apellidos", "id", "nivel"])
			-> first();

		return [
			'token' => $datos -> createToken('API Token') -> plainTextToken,
			"nombre" => $datos -> nombre,
			"apellidos" => $datos -> apellidos,
			"id" => $datos -> id,
			"nivel" => $datos -> nivel,
		];

	}

	public function logout(Request $request) {
		$usuario = Usuario::where("id", $request -> id) -> first();

		if(!$usuario -> tokens()) { // Revisar esto
			return response("El usuario no tiene tokens", 400);
		}

		$usuario -> tokens() -> delete();

		return response("OK");

		// return response() -> json(!$usuario -> tokens());
	}
}

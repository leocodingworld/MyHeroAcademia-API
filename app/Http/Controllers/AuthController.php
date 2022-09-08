<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
	public function login(Request $request) {
		$attr = $request -> validate([
			'email' => 'required|string|email|',
			'password' => 'required|string|'
		]);

		if (!Auth::attempt($attr)) {
			return response() -> json(
				["mensaje" => "El email o la contraseña introducida es incorrecta"],
				401
			);
		}

		$usuario = Usuario::where("email", $request -> email)
			-> select(["id", "nombre", "apellidos", "nivel", "activo"])
			-> first();

		if(!$usuario -> activo) {
			return response() -> json(
				["mensaje" =>
				"La cuenta está desactivada.\nContacte con el centro para obtener ayuda"],
				403
			);
		}

		return [
			'token' => $usuario -> createToken('API Token') -> plainTextToken,
			"id" => $usuario -> id,
			"nombre" => $usuario -> nombre,
			"apellidos" => $usuario -> apellidos,
			"nivel" => $usuario -> nivel
		];

	}

	public function logout(Request $request) {
		$tokenId = Str::limit($request -> bearerToken(), 1, "");

		$usuario = Usuario::find($request -> id);
		$usuario
			-> tokens
			-> where("id", $tokenId)
			-> first
			-> delete();

		return "OK?";
	}
}

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
            return ;
        }

		$datos = Usuario::where("email", $request -> email)
			-> select(["nombre", "idUsuario", "tipo"])
			-> first();

        return [
            'token' => $request -> user() -> createToken('API Token') -> plainTextToken,
			"nombre" => $datos -> nombre,
			"id" => $datos -> idUsuario,
			"nivel" => $datos -> tipo,
        ];

    }

	/**
	 * Pendiente de Arreglar
	 */
    public function logout(Request $request) {
		// $message = [
		// 	"Info" => "Testing"
		// ];

		// try {

		// 	// $token = $request -> user() -> tokens();
		// 	// $token -> where("id", $token -> id) -> delete();

		// 	$request -> user() -> currentAccessToken() -> delete();

		// 	$message["result"] = "OK";

		// } catch (Exception $e) {
		// 	$message["result"] = "NOP";
		// 	$message["error"] = $e -> getMessage();
		// }

        return auth() -> user();
    }
}

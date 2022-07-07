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

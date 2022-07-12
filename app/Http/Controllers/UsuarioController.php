<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
	public function getUsuarios() {
		return Usuario::all();
	}

	public function getUsuarioData($usuario) {
		return Usuario::where("idUsuario", $usuario) -> first();
	}

	public function activarUsuario(Request $request) { // OK
		$activar = Usuario::where("idUsuario", $request -> id) -> first();

		$activar -> activo = true;
		$activar -> save();

		return response("Correcto", 200);

		// return $request;
	}

	public function getAlumnos() {
		return Usuario::join();
	}
}

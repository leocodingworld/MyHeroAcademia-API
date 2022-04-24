<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Personal;
use App\Models\Alumno;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
	public function getUsuarios() {
		return Usuario::all();
	}

	public function getUsuariosFilter(Request $request) {

	}

	public function activarUsuario(Request $request) {
		$status = "";
		$activado = Usuario::where("email", $request -> email);

		if($activado) {
			$activado -> activo = true;

			$activado -> save();

			$status = "OK";
		} else {
			$status = "NotFound";
		}

		return [
			"status" => $status
		];
	}
}

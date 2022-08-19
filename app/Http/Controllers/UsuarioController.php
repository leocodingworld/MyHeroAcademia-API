<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
	public function createUsuario(Request $request) {
		$usuario = Usuario::insert([
			"dni" => $request -> dni,
			"nombre" => $request -> nombre,
			"apellidos" => $request -> apellidos,
			"direccion" => $request -> direccion,
			"municipio" => $request -> municipio,
			"localidad" => $request -> localidad,
			"provincia" => $request -> provincia,
			"codigoPostal" => $request -> codigoPostal,
			"telefono" => $request -> telefono,
			"fechaNacimiento" => $request -> fechaNacimiento,
			"email" => $request -> email,
			"password" => bcrypt("123abc.") ,
			"nivel" => $request -> nivel
		]);

		$status = $usuario ? "200" : "400";
		$mensaje = $usuario ? "OK" : "ERR";

		return response($mensaje, $status);
	}

	public function getUsuarios() {
		return Usuario::all();
	}

	public function getUsuarioData($usuario) { // OK
		return Usuario::where("id", $usuario) -> first();
	}

	public function activarUsuario(Request $request) { // OK

		if(!$request -> id) {
			return response("No hay datos", 400);
		}

		$activar = Usuario::where("id", $request -> id) -> first();

		$activar -> activo = true;
		$activar -> save();

		return response("Correcto", 200);
	}

	public function desactivarUsuario(Request $request) { // Funciona? A veces, sí otras no

		if(!$request -> id) {
			return response("No hay datos", 400);
		}

		$desactivar = Usuario::where("id", $request -> id) -> first();
		$desactivar -> activo = false;
		$desactivar -> save();

		return response("Correcto", 200);
	}

	public function getAlumnos() {
		return Usuario::join();
	}

	public function getPersonal() {
		return;
	}

	public function editarUsuario(Request $request) {

	}
}

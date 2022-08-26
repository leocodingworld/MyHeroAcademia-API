<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
	// CREATE

	public function createUsuario(Request $request) {
		$usuario = Usuario::create([
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

		// Buscar error

		if($request -> nivel == 1) {
			$this::createAlumno($usuario);
		} else {
			$this::createPersonal($usuario);
		}

		return true;
	}

	private static function createAlumno(Usuario $usuario) {
		$alumno = Alumno::create([
			"id" => $usuario -> id,
			"fechaMatricula" => date("Y-m-d")
		]);

		return $alumno;
	}

	private static function createPersonal(Usuario $usuario) {
		$personal = Personal::create([
			"id" => $usuario -> id
		]);

		return $personal;
	}

	// READ

	public function getUsuarios() {
		return Usuario::select("id", "nombre", "apellidos", "activo", "dni", "nivel")
			-> get();
	}

	public function getUsuarioData($usuario) { // OK
		return Usuario::where("id", $usuario) -> first();
	}

	public function getAlumnos() {
		return Usuario::join();
	}

	public function getPersonal() {
		return;
	}

	public function checkEmail($email) {
		return Usuario::where("email", $email) -> select("id") -> first();
	}

	public function checkDNI(Request $request) {

	}

	// UPDATE

	public function activarUsuario(Request $request) { // OK

		if(!$request -> id) {
			return response("No hay datos", 400);
		}

		$activar = Usuario::where("id", $request -> id) -> first();

		$activar -> activo = true;
		$activar -> save();

		return true;
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

	public function editarUsuario(Request $request) {

	}
}

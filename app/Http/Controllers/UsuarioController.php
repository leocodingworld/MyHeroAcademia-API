<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Repositories\Contracts\IUsuarioRepository;
use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
	private IUsuarioRepository $usuarioRepository;

	public function __construct(IUsuarioRepository $usuarioRepository)
	{
		$this -> usuarioRepository = $usuarioRepository;
	}

	// CREATE

	public function createUsuario(Request $request) {
		return $this -> usuarioRepository -> nuevoUsuario($request);
	}

	// READ

	public function getUsuarios() {
		return Usuario::select("id", "nombre", "apellidos", "activo", "dni", "nivel")
			-> get();
	}

	public function getUsuarioData($usuario) { // OK
		return Usuario::find($usuario);
	}

	public function getAlumnos() { // Añadir ciertos campos extras
		return Usuario::where("nivel", 1) -> select(["id", "nombre", "apellidos"]) -> get();
	}

	public function getPersonal() {
		return;
	}

	public function checkEmail($email) {
		return Usuario::where("email", $email) -> select("id") -> first();
	}

	public function checkDNI($dni) {
		return Usuario::where("dni", $dni) -> select("id") -> first();
	}

	// UPDATE

	public function activarUsuario(Request $request) {
		if(!$request -> id) {
			return response("No hay datos", 400);
		}

		$activar = Usuario::where("id", $request -> id) -> first();

		$activar -> activo = true;
		$activar -> save();

		return response() -> json([

		], 200);
	}

	public function desactivarUsuario(Request $request) {
		if(!$request -> id) {
			return response("No hay datos", 400);
		}

		$desactivar = Usuario::where("id", $request -> id) -> first();
		$desactivar -> activo = false;
		$desactivar -> save();

		return response("Correcto", 200);
	}

	public function editarUsuario(Request $request, $usuario) {
		return $this -> usuarioRepository -> editarUsuario($request, $usuario);
	}
}

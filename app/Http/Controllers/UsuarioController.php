<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Contracts\IUsuarioRepository;
use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
	private IUsuarioRepository $usuarioRepository;

	public function __construct(IUsuarioRepository $usuarioRepository)
	{
		$this -> usuarioRepository = $usuarioRepository;
	}

	// CREATE

	public function createUsuario(Request $request) {
		$usuario = Usuario::create([
			...($request -> collect()),
			"password" => bcrypt("123abc."),
			"sexo" => "Hombre"
		]);

		if($request -> nivel == 1) {
			$this -> createAlumno($usuario);
		} else {
			$this -> createPersonal($usuario);
		}

		return response() -> json([
			"mensaje" => "Usuario creado con éxito"
		]);
	}

	private function createAlumno(Usuario $usuario) {
		$alumno = new Alumno;

		$alumno -> id = $usuario -> id;
		$this -> createExpediente($alumno);

		return $alumno;
	}

	private function createExpediente(Alumno | Usuario $alumno) {
		$expediente = new Expediente();

		$expediente -> idAlumno = $alumno -> id;
		$expediente -> save();

		return $expediente;
	}

	private function createPersonal(Usuario $usuario) {
		$personal = new Personal;

		$personal -> id = $usuario -> id;

		return $personal;
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

	public function editarUsuario(Request $request) {

	}
}

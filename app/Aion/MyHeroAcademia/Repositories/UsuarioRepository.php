<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Repositories\Contracts\IUsuarioRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class UsuarioRepository implements IUsuarioRepository
{
	use ApiResponse;

	public function nuevoUsuario(Request $request) {
		$datos = Arr::collapse([
			$request -> collect() -> toArray(),
			"password" => bcrypt("123abc.")
		]);

		$usuario = Usuario::create($datos);

		if(!$usuario) { // ¿Añadir esto?
			return $this -> error(new Collection([
				"mensaje" => "Error al crear el Usuario"
			]));
		}

		if($usuario -> nivel == 1) {
			$this -> createAlumno($usuario);
		} else {
			$this -> createPersonal($usuario, $request -> numSegSocial, $request -> puesto);
		}

		return $this -> success(new Collection([
			"mensaje" => "Usuario creado con éxito"
		]));
	}

	private function createAlumno(Usuario $usuario) {
		$date = intval(date("Y"));

		$alumno = new Alumno;

		$alumno -> id = $usuario -> id;
		$alumno -> anho = $date . "/" . $date + 1;
		$alumno -> save();

		if(!$alumno) {
			return;
		}

		$this -> createExpediente($alumno);
	}

	private function createExpediente(Alumno $alumno) {
		$expediente = new Expediente;

		$expediente -> idAlumno = $alumno -> id;

		$expediente -> save();
	}

	private function createPersonal(Usuario $usuario, string|null $numSegSocial, string|null $puesto) {
		$personal = new Personal;

		$personal -> id = $usuario -> id;
		$personal -> numSegSocial = $numSegSocial ?? "01234567890";
		$personal -> puesto = $puesto ?? "No asignado";

		$personal -> save();
	}

	public function getUsuarios() {
		return Usuario::select("id", "nombre", "apellidos", "activo", "dni", "nivel")
		-> get();
	}

	public function getUsuarioByEmail(string $email) : Usuario | null
	{
		return Usuario::firstWhere("email", $email);
	}

	public function getDatosUsuario($usuario)
	{
		return Usuario::find($usuario);
	}

	public function getAlumnos()
	{
		return Usuario::where("nivel", 1) -> get();
	}

	public function getPersonal() {
		return Usuario::where("nivel", "!=", 1) -> get();
	}

	public function checkEmail($email) {
		return Usuario::select("id") -> firstWhere("email", $email);
	}

	public function checkDNI($dni) {
		return Usuario::select("id") -> firstWhere("dni", $dni);
	}

	public function modificarEstadoUsuario($usuario) {
		$usuario = Usuario::find($usuario);

		$estado = $usuario -> activo ? "des" : "";
		$usuario -> activo = !$usuario -> activo;

		$usuario -> save();

		return $this -> success(new Collection([
			"mensaje" => "Usuario {$estado}activado con éxito"
		]));
	}

	public function editarUsuario(Request $request, $usuario) {
		$usuario = Usuario::find($usuario)
			-> update($request -> collect() -> toArray());

		if(!$usuario) {
			return $this -> error(new Collection([
				"mensaje" => "Fallo al actualizar, revise los datos"
			]));
		}

		return $this -> success(new Collection([
			"mensaje" => "Datos del usuario actualizados con éxito"
		]));
	}
}

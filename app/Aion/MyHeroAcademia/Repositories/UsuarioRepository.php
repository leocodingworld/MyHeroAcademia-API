<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Repositories\Contracts\IUsuarioRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UsuarioRepository implements IUsuarioRepository
{
	use ApiResponse;

	public function nuevoUsuario(Request $request) {
		$usuario = Usuario::create([
			"dni" => $request -> dni,
			"nombre" => $request -> nombre,
			"apellidos" => $request -> apellidos,
			"sexo" => $request -> sexo ?? "hombre",
			"direccion" => $request -> direccion,
			"municipio" => $request -> municipio,
			"localidad" => $request -> localidad,
			"provincia" => $request -> provincia,
			"codigoPostal" => $request -> codigoPostal,
			"telefono" => $request -> telefono,
			"fechaNacimiento" => $request -> fechaNacimiento,
			"email" => $request -> email,
			"nivel" => $request -> nivel,
			"password" => bcrypt("123abc."),
		]);

		if(!$usuario) { // ¿Añadir esto?
			return $this -> error(new Collection([
				"mensaje" => "Error al crear el Usuario"
			]));
		}

		if($usuario -> nivel == 1) {
			$this -> createAlumno($usuario);
		} else {
			$this -> createPersonal($usuario);
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

	public function createPersonal(Usuario $usuario, string $numSegSocial) {
		$personal = new Personal;

		$personal -> id = $usuario -> id;
		$personal -> numSegSocial =
	}

	public function getUsuarios() {
	}

	public function getUsuarioById($id) {
	}

	public function getUsuarioByEmail(string $email) : Usuario | null
	{
		return Usuario::firstWhere("email", $email);
	}

	public function getDatosUsuario($usuario) {
	}

	public function getPersonal() {
	}

	public function checkEmail($email) {
	}

	public function checkDNI($dni) {
	}

	public function modificarEstadoUsuario($usuario) {
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

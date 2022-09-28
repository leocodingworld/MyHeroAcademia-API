<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Contracts\IUsuarioRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Models\Usuario;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Expediente;

class UsuarioRepository implements IUsuarioRepository
{
	use ApiResponse;

	public function nuevoUsuario(Request $request) {
		$usuario = Usuario::create($request -> collect());

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

	function createAlumno(Usuario $usuario) {
		$date = intval(date("Y"));

		$alumno = new Alumno;

		$alumno -> id = $usuario -> id;
		$alumno -> fechaMatricula = $date . "/" . $date + 1;
		$alumno -> save();

		if(!$alumno) {
			return ;
		}
	}

	function createExpediente(Alumno $alumno) {
		$expediente = new Expediente;

		$expediente -> idAlumno = $alumno -> id;

		$expediente -> save();
	}

	public function createPersonal(Usuario $usuario) {
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
	}
}

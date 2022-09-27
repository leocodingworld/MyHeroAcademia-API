<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Contracts\IUsuarioRepository;
use App\Models\Usuario;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Aion\MyHeroAcademia\Utils\ApiResponse;

class UsuarioRepository implements IUsuarioRepository
{
	use ApiResponse;

	/**
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	public function nuevoUsuario(Request $request) {
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
			"password" => bcrypt("123abc."),
			"nivel" => $request -> nivel
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

	/**
	 *
	 * @param \App\Models\Usuario $usuario
	 *
	 * @return mixed
	 */
	function createAlumno(Usuario $usuario) {
		$date = intval(date("Y"));

		$alumno = new Alumno;

		$alumno -> id = $usuario -> id;
		$alumno -> fechaMatricula = $date . "/" . $date + 1;
	}

	/**
	 *
	 * @param \App\Models\Alumno $alumno
	 *
	 * @return mixed
	 */
	function createExpediente(Alumno $alumno) {
	}

	/**
	 *
	 * @param \App\Models\Usuario $usuario
	 *
	 * @return mixed
	 */
	public function createPersonal(Usuario $usuario) {
	}

	/**
	 *
	 * @return mixed
	 */
	public function getUsuarios() {
	}

	/**
	 *
	 * @param mixed $id
	 *
	 * @return mixed
	 */
	public function getUsuarioById($id) {
	}

	public function getUsuarioByEmail(string $email) {

	}

	/**
	 *
	 * @param mixed $usuario
	 *
	 * @return mixed
	 */
	public function getDatosUsuario($usuario) {
	}

	/**
	 *
	 * @return mixed
	 */
	public function getPersonal() {
	}

	/**
	 *
	 * @param mixed $email
	 *
	 * @return mixed
	 */
	public function checkEmail($email) {
	}

	/**
	 *
	 * @param mixed $dni
	 *
	 * @return mixed
	 */
	public function checkDNI($dni) {
	}

	/**
	 *
	 * @param mixed $usuario
	 *
	 * @return mixed
	 */
	public function modificarEstadoUsuario($usuario) {
	}

	/**
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param mixed $usuario
	 *
	 * @return mixed
	 */
	public function editarUsuario(Request $request, $usuario) {
	}
}

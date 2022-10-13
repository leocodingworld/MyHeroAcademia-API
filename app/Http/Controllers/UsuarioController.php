<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Repositories\Contracts\IUsuarioRepository;
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
		return $this -> usuarioRepository -> getUsuarios();
	}

	public function getUsuarioData($usuario) { // OK
		return $this -> usuarioRepository -> getDatosUsuario($usuario);
	}

	public function getAlumnos() { // Añadir ciertos campos extras
		return $this -> usuarioRepository -> getAlumnos();
	}

	public function getPersonal() {
		return $this -> usuarioRepository -> getPersonal();
	}

	public function checkEmail($email) {
		return $this -> usuarioRepository -> checkEmail($email);
	}

	public function checkDNI($dni) {
		return $this -> usuarioRepository -> checkDNI($dni);
	}

	// UPDATE

	public function modificarEstadoUsuario($usuario)
	{
		return $this -> usuarioRepository -> modificarEstadoUsuario($usuario);
	}

	public function editarUsuario(Request $request, $usuario) {
		return $this -> usuarioRepository -> editarUsuario($request, $usuario);
	}
}

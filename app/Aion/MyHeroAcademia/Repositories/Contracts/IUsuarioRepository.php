<?php

namespace Aion\MyHeroAcademia\Repositories\Contracts;

use App\Models\Alumno;
use App\Models\Usuario;
use Illuminate\Http\Request;

interface IUsuarioRepository {
	public function nuevoUsuario(Request $request);
	public function getUsuarios();
	// public function getUsuarios($page = 1, $perPage = 15);
	public function getUsuarioById($id);
	public function getUsuarioByEmail(string $email);
	public function getDatosUsuario($usuario);
	public function getPersonal(); // ???
	public function checkEmail($email);
	public function checkDNI($dni);

	public function modificarEstadoUsuario($usuario);
	public function editarUsuario(Request $request, $usuario);
}

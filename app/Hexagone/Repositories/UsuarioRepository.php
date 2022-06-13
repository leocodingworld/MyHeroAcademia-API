<?php

namespace Hexagone\MyHeroAcademia\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
	public function addUsuario($userData)
	{
		return Usuario::create($userData);
	}

	public function getUsuarios()
	{
		return Usuario::all();
	}

	public function getUsuario($user)
	{
		return Usuario::where([]);
	}
}

<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Contracts\IAuthRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Aion\MyHeroAcademia\Contracts\IUsuarioRepository;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements IAuthRepository
{
	use ApiResponse;

	const HTTP_OK = 200;
	const HTTP_NOT_AUTH = 403;
	const HTTP_ERROR = 404;
	protected IUsuarioRepository $usuarioRepository;

	public function __construct(IUsuarioRepository $usuarioRepository)
	{
		$this -> usuarioRepository = $usuarioRepository;
	}

	public function login(AuthRequest $authRequest)
	{
		$usuario = $this -> usuarioRepository -> getUsuarioByEmail($authRequest -> email);

		if(!$usuario) {
			return $this -> error(new Collection([
				"mensaje" => "El email y/o la contraseña no son correctos"
			]));
		}

		if(!Hash::check($authRequest -> password, $usuario -> password)) {
			return $this -> error(new Collection([
				"mensaje" => "El email y/o la contraseña no son correctos"
			]));
		}

		return $this -> success(new Collection([
			'token' => $usuario -> createToken('API Token') -> plainTextToken,
			"id" => $usuario -> id,
			"nombre" => $usuario -> nombre,
			"apellidos" => $usuario -> apellidos,
			"nivel" => $usuario -> nivel
		]));
	}

	public function logout(AuthRequest $authRequest) {
		$usuario = $this -> usuarioRepository -> getUsuarioByEmail($authRequest -> email);

	}
}

<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Repositories\Contracts\IAuthRepository;
use Aion\MyHeroAcademia\Repositories\Contracts\IUsuarioRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthRepository implements IAuthRepository
{
	use ApiResponse;

	const HTTP_OK = 200;
	const HTTP_FORBIDDEN = 403;
	CONST HTTP_NOT_AUTH = 401;
	const HTTP_ERROR = 404;
	private IUsuarioRepository $usuarioRepository;

	public function __construct(IUsuarioRepository $usuarioRepository)
	{
		$this -> usuarioRepository = $usuarioRepository;
	}

	public function login(AuthRequest $authRequest)
	{
		$usuario = $this -> usuarioRepository -> getUsuarioByEmail($authRequest -> email);

		// Si el usuario no existe, ...
		if(!$usuario) {
			return $this -> error(new Collection([
				"mensaje" => "El email y/o la contraseña no son correctos"
			]), self::HTTP_NOT_AUTH);
		}

		// O no está activo...
		if(!$usuario -> activo) {
			return $this -> error(new Collection([
				"mensaje" => "La cuenta no está activada.\nContacte con el centro para ayuda"
			]), self::HTTP_FORBIDDEN);
		}

		// O la contraseña está mal,
		// devuelve un mensaje de error y código respondiente a ese error
		if(!Hash::check($authRequest -> password, $usuario -> password)) {
			return $this -> error(new Collection([
				"mensaje" => "El email y/o la contraseña no son correctos"
			], self::HTTP_NOT_AUTH));
		}

		return $this -> success(new Collection([
			'token' => $usuario -> createToken('API Token') -> plainTextToken,
			"id" => $usuario -> id,
			"nombre" => $usuario -> nombre,
			"apellidos" => $usuario -> apellidos,
			"nivel" => $usuario -> nivel
		]));
	}

	public function logout(Request $request)
	{
		$usuario = $this -> usuarioRepository -> getUsuarioByEmail($request -> email);

		if(!$usuario -> tokens) {
			return;
		}

		$tokenId = Str::limit($request -> bearerToken(), 1, "");
		$usuario
			-> tokens
			-> firstWhere("id", $tokenId)
			-> delete();

		return $this -> success(new Collection([
			"mensaje" => "Sesión cerrada"
		]));
	}
}

<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Contracts\IAuthRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements IAuthRepository
{
	use ApiResponse;

	const HTTP_OK = 200;
	const HTTP_NOT_AUTH = 403;
	const HTTP_ERROR = 404;
	protected IAuthRepository $authRepository;

	public function __construct(IAuthRepository $authRepository)
	{
		$this -> authRepository = $authRepository;
	}

	public function login(AuthRequest $authRequest)
	{
		$data = $authRequest -> validated();

		$usuario = $this -> authRepository -> getUsuarioEmail($authRequest -> email);



		return $this -> success(new Collection([]));
	}

	public function logout(AuthRequest $authRequest) {

	}
}

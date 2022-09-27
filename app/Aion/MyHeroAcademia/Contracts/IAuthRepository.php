<?php

namespace Aion\MyHeroAcademia\Contracts;

use App\Http\Requests\AuthRequest;

interface IAuthRepository {
	public function login(AuthRequest $authRequest);
	public function logout(AuthRequest $authRequest);
}

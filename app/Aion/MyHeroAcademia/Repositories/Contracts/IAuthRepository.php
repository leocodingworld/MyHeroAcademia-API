<?php

namespace Aion\MyHeroAcademia\Repositories\Contracts;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

interface IAuthRepository {
	public function login(AuthRequest $authRequest);
	public function logout(Request $authRequest);
}

<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Repositories\Contracts\IAuthRepository;
use App\Http\Requests\AuthRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
	private IAuthRepository $authRepository;

	public function __construct(IAuthRepository $authRepository)
	{
		$this -> authRepository = $authRepository;
	}

	public function login(AuthRequest $authRequest)
	{
		return $this -> authRepository -> login($authRequest);
	}

	public function logout(Request $request)
	{
		return $this -> authRepository -> logout($request);
	}
}

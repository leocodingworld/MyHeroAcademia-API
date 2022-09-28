<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Contracts\IAuthRepository;
use App\Http\Requests\AuthRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
	private IAuthRepository $authRepository;

	public function __construct(IAuthRepository $authRepository)
	{
		$this -> authRepository = $authRepository;
	}

	public function login(AuthRequest $authRequest) {
		return $this -> authRepository -> login($authRequest);
	}

	public function logout(Request $request) {
		$usuario = Usuario::find($request -> id);

		if(!$usuario -> tokens) {
			return response() -> json([], 404);
		}

		$tokenId = Str::limit($request -> bearerToken(), 1, "");
		$usuario
			-> tokens
			-> where("id", $tokenId)
			-> first
			-> delete();

		return response() -> json();
	}
}

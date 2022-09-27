<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(AuthRequest $authRequest) {
		return response() -> json($authRequest -> validated());
	}
}

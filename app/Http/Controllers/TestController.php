<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request) {
		return response() -> json($request -> collect());
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function getModulos() {
		return Modulo::all();
	}

	public function getModulosPorProfesor($profesor, $modulo) {
		return Modulo::join([])
			-> where([
				["profesor", $profesor],
				["id", $modulo]
			]);
	}
}

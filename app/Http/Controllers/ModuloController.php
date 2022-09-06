<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function getModulos() {
		return Modulo::all();
	}

	// Funciona
	// Mejorar en mandar los parámetros que hagan falta
	public function getModulosPorProfesor($profesor) {
		return Modulo::with("curso:id,nombre,nombreCorto")
			-> where("tutor", $profesor)
			-> get();
	}

	public function asignarModuloProfesor($modulo, $profesor) {
		$m = Modulo::find($modulo);
		$m -> tutor = $profesor;

		return $m -> save() ? "OK" : "ERR";
	}
}

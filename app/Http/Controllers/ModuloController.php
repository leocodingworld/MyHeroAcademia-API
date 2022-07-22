<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function getModulos() {
		return Modulo::all();
	}

	public function getModulosPorProfesor($profesor) { // OK
		return Modulo::join("cursos", "modulos.curso", "=", "cursos.id")
			-> where("modulos.profesor", $profesor)
			-> select(["modulos.id", "modulos.nivel", "cursos.nombreCorto", "modulos.nombre"])
			-> get();
	}
}

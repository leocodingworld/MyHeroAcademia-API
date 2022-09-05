<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Modulo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function getAlumnos() { // Añadir ciertos campos extras
		return Usuario::where("nivel", 1) -> select(["id", "nombre", "apellidos"]) -> get();
	}

	public function getAlumnosPorModulo($modulo) {
		return Modulo::find($modulo) -> alumnos;
	}
}

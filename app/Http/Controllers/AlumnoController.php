<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Modulo;
use App\Models\Usuario;

class AlumnoController extends Controller
{
	public function getAlumnos() {
		return Usuario::where("nivel", 1)
		-> select("id", "nombre", "apellidos")
		-> get();
	}

	public function matriculacion(Request $request) {
		$usuario = Usuario::find($request -> id);


	}

	public function editarAlumno($alumno, Request $request) {

	}
}

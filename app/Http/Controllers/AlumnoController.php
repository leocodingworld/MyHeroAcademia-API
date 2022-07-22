<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function getAlumnos() { // Añadir ciertos campos extras
		return Alumno::join("usuarios", "usuarios.id", "=", "alumnos.id")
			-> select(["alumnos.id", "usuarios.nombre", "usuarios.apellidos", "alumnos.fechaMatricula"])
			-> get();
	}

	public function getAlumnosPorModulo($modulo) {
		$sql = "
			SELECT
				usuarios.id,
				usuarios.nombre,
				usuarios.apellidos
			FROM usuarios, alumnos, alummodul, modulos
			WHERE
				usuarios.id = alumnos.id AND
				alumnos.id = alummodul.alumno AND
				alummodul.modulo = modulos.id AND
				modulos.id = ?
		";

		return DB::select($sql, [ $modulo ]);
	}
}

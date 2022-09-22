<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nota;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NotaController extends Controller
{
	public function getNotasPorAlumno($alumno) {
		// saco las notas del alumno
		$na = Usuario::find($alumno) -> alumno -> notas;

		// Me quedo solo con el campo del curso y los valores únicos
		$cursosIds = $na -> unique("curso") -> values() -> pluck("curso");

		// si salen más de un registro, me quedo normal.
		// Si solo hay uno solo me quedo con uno, recupero el valor
		$cursosIds = $cursosIds -> count() == 1
			? $cursosIds -> first()
			: $cursosIds;

		$curso = Curso::find($cursosIds);

		$modulos = $curso -> modulos;

		$notas = $modulos -> map(function($m) use ($na) {
			return new Collection([
				"modulo" => $m -> nombre,
				"notas" => $na -> where("modulo", $m -> id) -> makeHidden(["alumno", "curso", "modulo"]) -> flatten()
			]);
		});

		return response() -> json([
			"curso" => "{$curso -> nivel} {$curso -> nombre}",
			"modulos" => $notas
		]);
	}

	public function nuevaNota(Request $request) {
		$nota = new Nota();


	}
}

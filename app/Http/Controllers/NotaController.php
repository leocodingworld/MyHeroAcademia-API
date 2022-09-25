<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Nota;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NotaController extends Controller
{
	public function getNotas(string | int $alumno, string | int $modulo = null) {
		return $modulo
			? $this -> getNotasAlumnoPorModulo($alumno, $modulo)
			: $this -> getNotasAlumno($alumno);
	}

	private function getNotasAlumno(string | int $alumno) {
		$na = Nota::where("alumno", $alumno) -> get();

		$notas = $na -> groupBy("curso") -> map(function($notas, $curso) {
			$modulos = $notas -> groupBy("modulo") ->map(function($notas, $modulo) {
				return new Collection([
					"modulo" => Modulo::find($modulo) -> nombre,
					"nota" => $notas -> makeHidden(["alumno", "anho", "curso", "modulo"])
				]);
			}) -> values();

			$c = Curso::find($curso);

			return new Collection([
				"curso" => "{$c -> nivel} {$c -> nombre}",
				"modulos" => $modulos
			]);
		}) -> values();

		return $notas;
	}

	private function getNotasAlumnoPorModulo(string | int $alumno, string | int $modulo) {
		return Nota::where([
			[ "alumno", $alumno ],
			[ "modulo", $modulo ]
		])
		-> select("referencia", "calificacion", "observaciones", "periodo")
		-> get();
	}

	public function nuevaNota(Request $request) {
		$nota = new Nota();

		$nota -> alumno = $request -> alumno;
		$nota -> curso = $request -> curso;
		$nota -> modulo = $request -> modulo;
		$nota -> periodo = $request -> periodo;
		$nota -> calificacion = $request -> calificacion;
		$nota -> observaciones = $request -> observaciones ?? null;

		$nota -> saveOrFail();

		return response() -> json([
			"mensaje" => "Nota registrada con éxito"
		]);
	}
}

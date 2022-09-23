<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ExpedienteController extends Controller
{

	/**
	 * @param int $alumno
	 *
	 */
	public function getLineasExpediente($alumno) {
		$ls = Expediente::firstWhere("alumno", $alumno) -> lineas;
		$anhos = $ls -> unique("anho") -> values() -> pluck("anhos");

		$cursosId = $ls -> unique("idCurso") -> values() -> pluck("idCurso");
		$cursos = Curso::find($cursosId);
		$cursos = $cursos -> count() == 1
			? $cursos -> first()
			: $cursos;

		$modulosId = $ls -> unique("idModulo") -> values() -> pluck("idModulo");
		$modulos = Modulo::find($modulosId);

		$lineas = $ls -> map(function($l) use($modulos) {
			$m = $modulos -> firstWhere("id", $l -> idModulo) -> nombre;

			$lineas = new Collection([
				"nombre" => $m,
				"calificacion" => $l -> calificacion,
				"convocatoria" => $l -> convocatoria,
				"observaciones" => $l -> observaciones
			]);

			return $lineas;
		});



		return $lineas;
	}

	public function nuevaLinea(Request $request) {

	}

	public function editarLinea($linea, Request $request) {

	}
}

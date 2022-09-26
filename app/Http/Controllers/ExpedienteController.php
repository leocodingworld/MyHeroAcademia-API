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
	public function getLineasExpediente($alumno) {
		$l = Expediente::firstWhere("idAlumno", $alumno) -> lineas;

		$lineas = $l -> groupBy("anho") -> map(function($lanho, $anho) {
			$cursos = $lanho -> groupBy("idCurso") -> map(function($lmodulo, $curso) {
				$modulos = $lmodulo -> groupBy("idModulo") -> map(function($lineas, $modulo) {
					$l = $lineas -> first();

					return new Collection([
						"linea" => $l -> linea,
						"modulo" => Modulo::find($modulo) -> nombre,
						"calificacion" => $l -> calificacion,
						"convocatoria" => $l -> convocatoria,
						"observaciones" => $l -> observaciones,
					]);
				}) -> values();

				return new Collection([
					"curso" => Curso::find($curso) -> nombre,
					"modulos" => $modulos
				]);
			}) -> values();

			return new Collection([
				"anho" => $anho,
				"cursos" => $cursos
			]);
		})  -> values();

		return $lineas;
	}

	public function nuevaLinea(Request $request) {

	}

	public function editarLinea($linea, Request $request) {

	}
}

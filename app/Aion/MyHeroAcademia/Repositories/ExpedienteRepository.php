<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Repositories\Contracts\IExpedienteRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Models\Curso;
use App\Models\Expediente;
use App\Models\Modulo;
use Illuminate\Support\Collection;

class ExpedienteRepository implements IExpedienteRepository
{
	use ApiResponse;

	public function getLineasExpediente($alumno)
	{
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

				$c = Curso::find($curso);

				return new Collection([
					"curso" => "{$c -> nivel} {$c -> nombre}",
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
}

<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Utils\ApiResponse;
use Aion\MyHeroAcademia\Repositories\Contracts\INotaRepository;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Nota;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Exception;

class NotaController extends Controller
{
	use ApiResponse;

	private INotaRepository $notaRepository;

	public function __construct(INotaRepository $notaRepository)
	{
		$this -> notaRepository = $notaRepository;
	}

	public function getNotas(string | int $alumno, string | int $modulo = null) {
		return $modulo
			? $this -> getNotasAlumnoPorModulo($alumno, $modulo)
			: $this -> getNotasAlumno($alumno);
	}

	private function getNotasAlumno(string | int $alumno) {
		$na = Nota::where("idAlumno", $alumno) -> get();

		$notas = $na -> groupBy("idCurso") -> map(function($notas, $curso) {
			$modulos = $notas -> groupBy("idModulo") -> map(function($notas, $modulo) {
				return new Collection([
					"modulo" => Modulo::find($modulo) -> nombre,
					"nota" => $notas
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
			[ "idAlumno", $alumno ],
			[ "idModulo", $modulo ]
		])
		-> select("referencia", "periodo", "calificacion", "observaciones")
		-> get();
	}

	public function nuevaNota(Request $request) {

	}
}

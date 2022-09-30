<?php

namespace Aion\MyHeroAcademia\Repositories;

use Aion\MyHeroAcademia\Repositories\Contracts\INotaRepository;
use Aion\MyHeroAcademia\Utils\ApiResponse;
use App\Models\Nota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NotaRepository implements INotaRepository
{
	use ApiResponse;

	function getNotasAlumno($alumno) {
		return Nota::where("idAlumno", $alumno) -> get();
	}

	function getNotasAlumnoByModulo($alumno, $modulo) {
		return Nota::where([
			[ "idAlumno", $alumno ],
			[ "idModulo", $modulo ]
		])
		-> select("referencia", "periodo", "calificacion", "observaciones")
		-> get();
	}

	function nuevaNota(Request $request) {
		try {
			Nota::create($request -> collect() -> toArray());
		} catch(Exception $e) {
			return $this -> error(new Collection([
				"mensaje" => "Error al registrar la nota.\nVuelve a revisar los datos"
			]), 500);
		}

		return $this -> success([
			"mensaje" => "Nota registrada con éxito"
		]);
	}

	function modificarNota(Request $request, $referencia) {
	}
}

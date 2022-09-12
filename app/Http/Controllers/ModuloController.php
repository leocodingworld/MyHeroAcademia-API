<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Exception;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function getModulos() {
		return Modulo::all();
	}

	public function getAlumnosPorModulo($modulo) {
		return Modulo::find($modulo) -> alumnos;
	}

	// Funciona
	// Mejorar en mandar los parámetros que hagan falta
	public function getModulosPorProfesor($profesor) {
		return Modulo::with("curso:id,nombre,nombreCorto")
			-> where("tutor", $profesor)
			-> get();
	}

	public function asignarModuloProfesor($modulo, $profesor) {
		$m = Modulo::find($modulo);
		$m -> tutor = $profesor;

		try  {
			$m -> saveOrFail();
		} catch(Exception $e) {
			return response() -> json([
				"mensaje" => "No existe el profesor en la base de datos"
			], 401);
		}

		return response() -> json([
			"mensaje" => "Operación realizada con éxito"
		], 200);
	}
}

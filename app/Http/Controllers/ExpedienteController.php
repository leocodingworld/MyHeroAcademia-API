<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function getExpedientes() {
		return Expediente::all(); // ???
	}

	public function getLineasExpediente($alumno, $modulo = null) {
		$expediente = Expediente::where("alumno", $alumno) -> first();

		if(!$expediente) {
			return response() -> json([
				"mensaje" => "Alumno no encontrado"
			], 404);
		}

		return $modulo
			? $expediente -> lineas -> where("modulo", $modulo) -> first()
			: $expediente -> lineas;
	}
}

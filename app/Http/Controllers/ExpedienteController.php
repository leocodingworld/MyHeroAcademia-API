<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\LineaExpediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function getExpedientes() {
		return Expediente::all(); // ???
	}

	public function getLineasExpediente($alumno, $modulo = null) {
		$expediente = Expediente::where("alumno", $alumno) -> select("id") -> get();

		if(!$expediente) {
			return response() -> json([
				"mensaje" => "Alumno no encontrado"
			], 404);
		}

		$lineas = LineaExpediente::where("numExpediente", $expediente -> id) -> get();

		return $lineas;
	}
}

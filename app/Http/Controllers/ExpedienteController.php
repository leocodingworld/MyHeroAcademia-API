<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function getExpedientes() {
		return Expediente::all(); // ???
	}

	public function getLineasExpediente($alumno, Request $request) {
		$expediente = Expediente::where("alumno", $alumno) -> first();

		return $expediente -> lineasExpediente-> where("modulo", $request -> modulo);
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Modulo;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function getExpedientes() {
		return Expediente::all(); // ???
	}

	public function getLineasExpediente($alumno, $modulo) {
		$expediente = Expediente::where("alumno", $alumno) -> get();

		if(!$expediente) {
			return response() -> json([
				"mensaje" => "Alumno no encontrado"
			], 404);
		}

		if($modulo) {
			return $expediente -> lineas -> where("modulo", $modulo);
		}

		$lineas = $expediente -> lineas;
		$cursoId = $lineas
			-> pluck("idCurso")
			-> unique()
			-> values();

		$modulosId = $lineas
			-> pluck("modulos")
			-> unique()
			-> values();

		$loscursos = Curso::select("id", "nombre", "nombreCorto")
			-> find($cursoId);
		$losmodulos = Modulo::select("id", "nombre", "nombreCorto")
			-> find($modulosId);

		$m = $losmodulos -> map(function($md) use($lineas) {
			$lmd = $lineas -> where("modulo", $md -> id);

			return [
				"id" => $md -> id,
				"nombre" => $md -> nombre,
				"nombreCorto" => $md -> nombreCorto,
				"lineas" => [
					"numero" => $lmd -> numero,
					"fecha" => $lmd -> fecha,
					"periodo" => $lmd -> periodo,
					"calificacion" => $lmd -> calificacion,
					"observaciones" => $lmd -> observaciones,
				]
			];
		});

		return [
			// "numExpediente" => $expediente -> id,
			// "cursos" => []
		];
	}

	public function nuevaLinea(Request $request) {

	}

	public function editarLinea($linea, Request $request) {

	}
}

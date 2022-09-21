<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class NotaController extends Controller
{
	public function getNotasPorAlumno($alumno) {
		$n = Usuario::find($alumno) -> alumno -> notas;

		$notas = $n -> map(function($n) {

		});
	}
}

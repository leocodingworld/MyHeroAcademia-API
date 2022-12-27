<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function getCursos() {
		return Curso::select(["id", "nombre", "nombreCorto", "nivel"]) -> get();
	}
}

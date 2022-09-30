<?php

namespace Aion\MyHeroAcademia\Repositories\Contracts;
use Illuminate\Http\Request;



interface INotaRepository {
	public function getNotasAlumno($alumno);
	public function getNotasAlumnoByModulo($alumno, $modulo);
	public function nuevaNota(Request $request);
	public function modificarNota(Request $request, $referencia);
}

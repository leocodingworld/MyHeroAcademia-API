<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Usuario;
use App\Models\Curso;
use App\Models\Listado;
use App\Models\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$alumnos = Alumno::all(["id"]);
		$modulos = Modulo::whereIn("idCurso", [1, 2]) -> select("id", "idCurso") -> get();

		$alumnos -> each(function($a) use ($modulos) {
			$modulos -> each(function($m) use ($a) {
				Listado::create([
					"idCurso" => $m -> idCurso,
					"idModulo" => $m -> id,
					"idAlumno" => $a -> id
				]);
			});
		});
    }
}

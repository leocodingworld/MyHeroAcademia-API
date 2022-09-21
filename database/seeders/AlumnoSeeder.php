<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Listado;
use App\Models\Modulo;

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
		$modulos = Modulo::whereIn("idCurso", 1) -> select("id", "idCurso") -> get();

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

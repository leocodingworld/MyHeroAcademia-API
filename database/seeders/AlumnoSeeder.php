<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Curso;
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
        $alumnos1 = Usuario::where("nivel", 1)
			-> take(8)
			-> get();

		$alumnos2 = Usuario::where("nivel", 1)
			-> skip(8)
			-> take(8)
			-> get();

		$cursos1 = Curso::all() -> take(4);
		$cursos2 = Curso::all() -> skip(4) -> take(4);

		$alumnos1 -> each(function($alumno) use ($cursos1) {
			$cursos1 -> each(function($c) use ($alumno) {
				$c -> modulos -> each(function($m) use ($alumno) {
					DB::table("alumnoModulo") -> insert([
						"alumno" => $alumno -> id,
						"curso" => $m -> idCurso,
						"modulo" => $m -> id
					]);
				});
			});
		});

		$alumnos2 -> each(function($alumno) use ($cursos2) {
			$cursos2 -> each(function($c) use ($alumno) {
				$c -> modulos -> each(function($m) use ($alumno) {
					DB::table("alumnoModulo") -> insert([
						"alumno" => $alumno -> id,
						"curso" => $m -> idCurso,
						"modulo" => $m -> id
					]);
				});
			});
		});
    }
}

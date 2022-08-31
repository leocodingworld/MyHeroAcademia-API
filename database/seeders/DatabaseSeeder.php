<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Usuario;
use App\Models\Modulo;
use App\Models\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		// Usuario::factory(50) -> create();
		// $usuarios = Usuario::select(["id", "nivel"]) -> get();

		// $usuarios -> each(function($usuario) {
		// 	if($usuario -> nivel == 1) {
		// 		Alumno::insert([
		// 			"id" => $usuario -> id,
		// 			"fechaMatricula" => "2022-08-29"
		// 		]);
		// 	} else {
		// 		Personal::insert([
		// 			"id" => $usuario -> id,
		// 			"numSegSocial" => "01234567890",
		// 			"puesto" => "No Asisgnado"
		// 		]);
		// 	}
		// });

		$alumnos = Alumno::select("id") -> get();
		$modulos = Modulo::select(["id", "curso"])
			-> whereIn("curso", [1, 2, 3, 4, 5])
			-> get();

		$modulos -> each(function($modulo) use ($alumnos) {
			$alumnos -> each(function($alumno) use ($modulo) {
				DB::table("alumnoModulo") -> insert([
					"anho" => date("Y-m-d"),
					"alumno" => $alumno -> id,
					"curso" => $modulo -> curso,
					"modulo" => $modulo -> id
				]);
			});
		});
    }
}

<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Usuario;
use App\Models\Modulo;
use App\Models\Password;
use App\Models\Personal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		Usuario::factory(50) -> create();

		$alumnos = Usuario::where("nivel", 1) -> get();
		$personal = Usuario::where("nivel", "!=", 1) -> get();

		$alumnos -> each(function($alumno){
			Alumno::insert([
				"id" => $alumno -> id,
				"fechaMatricula" => date("Y-m-d")
			]);

			Expediente::insert([
				"alumno" => $alumno -> id
			]);
		});

		$personal -> each(function($empleado) {
			Personal::insert([
				"id" => $empleado -> id,
				"numSegSocial" => "12345678910",
				"puesto" => "No Asignado"
			]);
		});
    }
}

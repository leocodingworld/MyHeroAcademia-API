<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalAlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$this -> command -> info("Añadiendo alumnos con expedientes y personal a sus tablas");

		$alumnos = Usuario::where("nivel", 1) -> get();
		$personal = Usuario::where("nivel", "!=", 1) -> get();

		$alumnos -> each(function($alumno){
			Alumno::insert([
				"id" => $alumno -> id,
				"anho" => "2022/2023"
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

<?php

namespace Database\Seeders;

use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Nota;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineaExpedienteSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$con = ["Ordinaria", "Extraordinaria"];
		$exps = Expediente::all();

		foreach($exps as $e) {
			$i = 1;
			$notasAlumno = Nota::where("alumno", $e -> alumno) -> get();
			$notasAlumnosCurso = $notasAlumno -> groupBy("modulo") -> map(function($notas, $modulo) {
				return new \Illuminate\Support\Collection([
					"modulo" => $modulo,
					"media" => $notas -> avg("calificacion")
				]);
			});

			foreach($notasAlumnosCurso as ["modulo" => $modulo, "media" => $media]) {
				$e -> lineas() -> create([
					"linea" => $i,
					"anho" => "2022/2023",
					"calificacion" => $media,
					"idCurso" => Modulo::find($modulo) -> idCurso,
					"idModulo" => $modulo,
					"convocatoria" => $con[rand(0, 1)]
				]);

				$i++;
			}
		}
	}
}

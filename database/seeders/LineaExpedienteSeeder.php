<?php

namespace Database\Seeders;

use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Curso;
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
		$notas = Nota::all();
		$mids = $notas -> unique("modulo") -> values() -> pluck("modulo");
		$cids = $notas -> unique("curso") -> values() -> pluck("curso");

		foreach($exps as $e) {
			$i = 1;

			foreach($cids as $c) {

				foreach($mids as $m) {
					$linea = LineaExpediente::create([
						"numExpediente" => $e -> numero,
						"anho" => "2022/2023",
						"linea" => $i,
						"idCurso" => $c,
						"idModulo" => $m,
						"convocatoria" => $con[rand(0,1)],
						"calificacion" => $notas
							-> where("alumno", $e -> alumno)
							-> where("modulo", $m)
							-> avg("calificacion"),
					]);

					$this -> command -> info(json_encode($linea, JSON_PRETTY_PRINT));

					$i++;
				}
			}
		}
	}
}

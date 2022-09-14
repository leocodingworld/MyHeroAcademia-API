<?php

namespace Database\Seeders;

use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Curso;
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
			$periodos = [
				"1ª Evaluación",
				"2ª Evaluación",
				"1ª Evaluación Final Ordinaria",
				"2ª Evaluación Final Ordinaria",
				"1ª Evaluación Final Extraordinaria",
				"2ª Evaluación Final Extraordinaria"
			];

			$cursos1 = Curso::all() -> take(4);
			$cursos2 = Curso::all() -> skip(4) -> take(4);

			$expedientes1 = Expediente::all() -> take(8);
			$expedientes2 = Expediente::all() -> skip(8) -> take(8);

			foreach($expedientes1 as $e) {
				$i = 1;
				$linea = new LineaExpediente();

				foreach($cursos1 as $c) {

					foreach($c -> modulos as $m) {
						$linea -> numExpediente = $e -> numero;
						$linea -> numero = $i;
						$linea -> idCurso = $m -> idCurso;
						$linea -> modulo = $m -> id;
						$linea -> fecha = date("Y-m-d");
						$linea -> periodo = $periodos[rand(0,5)];
						$linea -> calificacion = rand(1,10);

						$linea -> save();
						$i++;
					}
				}
			}

			foreach($expedientes2 as $e) {
				$i = 1;
				$linea = new LineaExpediente();

				foreach($cursos2 -> modulos as $m) {
					foreach($c -> modulos as $m) {
						$linea -> numExpediente = $e -> numero;
						$linea -> numero = $i;
						$linea -> idCurso = $m -> idCurso;
						$linea -> modulo = $m -> id;
						$linea -> fecha = date("Y-m-d");
						$linea -> periodo = $periodos[rand(0,5)];
						$linea -> calificacion = rand(1,10);

						$linea -> save();
						$i++;
					}
				}
			}
			}
}

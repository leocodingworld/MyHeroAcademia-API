<?php

namespace Database\Seeders;

use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Modulo;
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
		$modulos = Modulo::all();
		$expedientes = Expediente::all();
		$periodos = [
			"1ª Evaluación",
			"2ª Evaluación",
			"1ª Evaluación Final",
			"2ª Evaluación Final",
			"1ª Evaluación Final Extraordinaria",
			"2ª Evaluación Final Extraordinaria",
		];

		foreach($expedientes as $exp) {
			$i = 1;

			foreach($modulos as $mod) {
				$linea = new LineaExpediente();

				$linea -> numExpediente = $exp -> numero;
				$linea -> linea = $i;
				$linea -> idCurso = $mod -> idCurso;
				$linea -> modulo = $mod -> id;
				$linea -> fecha = date("Y-m-d");
				$linea -> periodo = $periodos[rand(0, count($periodos) - 1)];
				$linea -> calificacion = rand(1,10);

				$linea -> save();

				$i++;
			}
		}
    }
}

<?php

namespace Database\Seeders;

use App\Models\Listado;
use App\Models\Nota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listados = Listado::all();
		$periodos = [
			"1ª Evaluación",
			"2ª Evaluación",
			"3ª Evaluación",
			"1ª Evaluación Final Ordinaria",
			"2ª Evaluación Final Ordinaria",
			"1ª Evaluación Final Extraordinaria",
			"2ª Evaluación Final Extraordinaria",
		];

		$listados -> each(function($l) use ($periodos) {
			foreach($periodos as $p) {
				Nota::create([
					"alumno" => $l -> idAlumno,
					"anho" => "2022/2023",
					"curso" => $l -> idCurso,
					"modulo" => $l -> idModulo,
					"periodo" => $p,
					"calificacion" => rand(1,10)
				]);
			}
		});
    }
}

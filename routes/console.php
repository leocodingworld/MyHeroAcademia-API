<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Inspiring;
use App\Models\Curso;
use App\Models\Expediente;
use App\Models\LineaExpediente;
use App\Models\Modulo;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command("test", function() {
	$expediente = Expediente::find(1);
	$lineas = $expediente -> lineas;
	$cursosPivot = $modulosPivot = $lineasPivot = collect([]);
	$res = "";

	$cursoId = $lineas
		-> pluck("idCurso")
		-> unique()
		-> values();

	$modulosId = $lineas
		-> pluck("modulo")
		-> unique()
		-> values();

	$cursos = Curso::select("id", "nombre", "nombreCorto")
		-> find($cursoId);
	$modulos = Modulo::select("id", "nombre", "nombreCorto")
		-> find($modulosId);

	// $this -> info($modulos -> toJson(JSON_PRETTY_PRINT));

	foreach($cursos as $c) {
		foreach($modulos as $m) {
			foreach($lineas -> where("modulo", $m -> id) as $l) {
				$lineasPivot = $lineasPivot
					-> merge([
						"linea" => $l -> linea,
						"fecha" => $l -> fecha,
						"periodo" => $l -> perido,
						"calificacion" => $l -> calificacion,
						"observaciones" => $l -> observaciones
					]);
			}

			$modulosPivot = $modulosPivot -> merge([
				"id" => $m ->id,
				"nombre" => $m -> nombre,
				"nombreCorto" => $m -> nombreCorto,
				"lineas" => $lineasPivot
			]);
		}

		$cursosPivot = $cursosPivot -> merge([
			"id" => $m ->id,
			"nombre" => $m -> nombre,
			"nombreCorto" => $m -> nombreCorto,
			"modulos" => $modulosPivot
		]);
	}



	$this -> info($cursosPivot -> toJson(JSON_PRETTY_PRINT));
});


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

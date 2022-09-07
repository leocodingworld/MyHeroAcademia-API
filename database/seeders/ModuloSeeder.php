<?php

namespace Database\Seeders;

use App\Models\Modulo;
use App\Models\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$modulosCsv = fopen(base_path("database/files/modulos.csv"), "r");
		$pivot = true;

		while(($data = fgetcsv($modulosCsv, 555, ",")) !== false) {
			if(!$pivot){
				Modulo::insert([
					"id" => $data["0"],
					"idCurso" => $data["1"],
					"nombre" => $data["2"],
					"nombreCorto" => $data["3"],
					"horas" => $data["4"],
				]);
			}

			$pivot = false;
		}

		fclose($modulosCsv);

		$this -> command -> info("Asignando módulos");

		$modulos = Modulo::all();

		$profesores = Personal::all();

		$conteo = $modulos -> count() < $profesores -> count()
			? $modulos -> count()
			: $profesores -> count();

		for($i = 0; $i < $conteo; $i++) {
			$modulos[$i] -> tutor = $profesores[$i] -> id;

			$modulos[$i] -> save();
		}

		$this -> command -> info("Añadiendo alumnos a los módulos");


    }
}

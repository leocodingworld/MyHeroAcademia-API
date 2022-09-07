<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this -> command -> info("Rellenando cursos y módulos");

		$cursoCsv = fopen(base_path("database/files/cursos.csv"), "r");
		$pivot = true;

		while(($data = fgetcsv($cursoCsv, 555, ",")) !== false)	 {
			if(!$pivot){
				Curso::insert([
					"id" => $data["0"],
					"nombre" => $data["1"],
					"nombreCorto" => $data["2"],
					"tipo" => $data["3"],
					"nivel" => $data["4"],
				]);
			}

			$pivot = false;
		}

		fclose($cursoCsv);

		$this -> command -> info("Asignando cursos");

		$cursos = Curso::all();
		$profesores = Personal::all();
		$conteo = $cursos -> count() < $profesores -> count()
			? $cursos -> count()
			: $profesores -> count();;

		for($i = 0; $i < $conteo; $i++) {
			$cursos[$i] -> tutor = $profesores[$i] -> id;

			$cursos[$i] -> save();
		}
    }
}

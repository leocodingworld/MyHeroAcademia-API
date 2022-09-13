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
		$cursos1 = Curso::all() -> take(4);
		$cursos2 = Curso::all() -> skip(4) -> take(4);

		$expedientes = Expediente::all();


    }
}

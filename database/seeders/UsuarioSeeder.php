<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this -> command -> info("Creando Usuarios");

		Usuario::insert([
			[
				"dni" => "00000000A",
				"nombre" => "Alumno",
				"apellidos" => "Alumno",
				"sexo" => "Hombre",
				"direccion" => "Calle Vete a Saber 69",
				"municipio" => "Ciudad",
				"localidad" => "Ciudad",
				"provincia" => "Comunidad",
				"codigoPostal" => "69069",
				"telefono" => "123 456 789",
				"fechaNacimiento" => "2000-01-01",
				"email" => "alumno@myheroac.es",
				"nivel" => 1,
				"password" => bcrypt("123abc.")
			],
			[
				"dni" => "00000001B",
				"nombre" => "Profesor",
				"apellidos" => "Profesor",
				"sexo" => "Hombre",
				"direccion" => "Avenida Desconocida 404",
				"municipio" => "Ciudad",
				"localidad" => "Ciudad",
				"provincia" => "Comunidad",
				"codigoPostal" => "69069",
				"telefono" => "123 456 789",
				"fechaNacimiento" => "1960-01-01",
				"email" => "profesor@myheroac.es",
				"nivel" => 2,
				"password" => bcrypt("123abc.")
			],
			[
				"dni" => "00000002C",
				"nombre" => "Directivo",
				"apellidos" => "Directivo",
				"sexo" => "Mujer",
				"direccion" => "Urbanización Perdida",
				"municipio" => "Pueblo",
				"localidad" => "Ciudad",
				"provincia" => "Comunidad",
				"codigoPostal" => "69069",
				"telefono" => "123 456 789",
				"fechaNacimiento" => "1970-01-01",
				"email" => "directivo@myheroac.es",
				"nivel" => 3,
				"password" => bcrypt("123abc.")
			],
		]);

		Usuario::factory(50) -> create();
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			"dni" => $this -> faker -> dni(),
            "nombre" => $this -> faker -> firstName(),
			"apellidos" => $this -> faker -> lastName(),
			"direccion" => $this -> faker -> streetAddress(),
			"localidad" => $this -> faker -> city(),
			"municipio" => $this -> faker -> city(),
			"provincia" => $this -> faker -> state(),
			"codigoPostal" => $this -> faker -> postcode(),
			"fechaNacimiento" => $this -> faker -> date("d/m/Y"),
			"email" => $this -> faker -> email(),
			"telefono" => Str::replace("-", "", $this -> faker -> phoneNumber()),
			"password" => bcrypt("123abc."),
			"tipo" => $this -> faker -> randomElement([1, 2, 3]),
        ];
    }
}

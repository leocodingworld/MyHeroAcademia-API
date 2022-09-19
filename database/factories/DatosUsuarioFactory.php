<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DatosUsuario>
 */
class DatosUsuarioFactory extends Factory
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
			"sexo" => $this -> faker -> randomElement(["Hombre", "Mujer"]),
			"direccion" => $this -> faker -> streetAddress(),
			"localidad" => $this -> faker -> city(),
			"municipio" => $this -> faker -> city(),
			"provincia" => $this -> faker -> state(),
			"codigoPostal" => $this -> faker -> postcode(),
			"fechaNacimiento" => $this -> faker -> date(),
			"telefono" => $this -> faker -> phoneNumber(),
        ];
    }
}

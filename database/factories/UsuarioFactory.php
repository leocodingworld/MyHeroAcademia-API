<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            "nombre" => $this -> faker -> firstName(),
			"apellidos" => $this -> faker -> lastName(),
			"email" => $this -> faker -> email(),
			"direccion" => "Sin Info",
			"telefono" => "123456789",
			"password" => bcrypt("123abc."),
			"tipo" => $this -> faker -> randomElement([0, 1, 2, 3, 4]),
        ];
    }
}

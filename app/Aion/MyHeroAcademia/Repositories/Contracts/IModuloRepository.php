<?php

namespace Aion\MyHeroAcademia\Repositories\Contracts;

interface IModuloRepository {
	public function getModulos();
	public function getAlumnosPorModulo(string|int $modulo);
	public function getModulosPorProfesor(string|int $profesor);
	public function asignarModuloAProfesor(string|int $profesor, string|int $modulo);
}

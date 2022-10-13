<?php

namespace App\Http\Controllers;

use Aion\MyHeroAcademia\Repositories\Contracts\IExpedienteRepository;

class ExpedienteController extends Controller
{
	private IExpedienteRepository $expedienteRepository;

	public function __construct(IExpedienteRepository $expedienteRepository)
	{
		$this -> expedienteRepository = $expedienteRepository;
	}

	public function getLineasExpediente($alumno)
	{
		return $this -> expedienteRepository -> getLineasExpediente($alumno);
	}

}

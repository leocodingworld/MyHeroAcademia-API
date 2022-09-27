<?php

namespace Aion\MyHeroAcademia\Utils;

use Illuminate\Support\Enumerable;

trait ApiResponse
{
	public function success(array | Enumerable $data) {
		return response() -> json($data);
	}

	public function error(array | Enumerable $data, $status = 404) {
		return response() -> json($data, $status);
	}
}

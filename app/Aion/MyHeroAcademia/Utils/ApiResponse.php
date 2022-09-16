<?php

namespace Aion\MyHeroAcademia\Utils;

trait ApiResponse {

	public function success(array $data) {
		return response() -> json($data);
	}

	public function error(array $data, $status) {
		return response() -> json($data, ($status ?: 404));
	}
}

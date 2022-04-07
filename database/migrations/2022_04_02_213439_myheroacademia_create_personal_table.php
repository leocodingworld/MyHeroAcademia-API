<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personal', function (Blueprint $table) {
			$table -> id("idPersonal");
			$table -> string("numeroSegSocial", 11);
			$table -> set("puesto", [

			]);

			$table
				-> foreign("idPersonal")
				-> references("id")
				-> on("usuarios");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('personal');
	}
};

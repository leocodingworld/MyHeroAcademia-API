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
        Schema::create("tipos", function(Blueprint $table) {
			$table -> tinyIncrements("idTipo");
			$table -> string("nombre");
		});

		Schema::create("usuarios", function(Blueprint $table) {
			$table -> id("idUsuario");

			$table -> string("nombre", 25);
			$table -> string("apellidos", 35);
			$table -> string("direccion", 45);
			$table -> string("telefono", 9);
			$table -> binary("password");
			$table -> boolean("activo") -> default(false);
			$table -> tinyInteger("tipo", false, true);

			// $table
			// 	-> foreign("tipo")
			// 	-> references("idTipo")
			// 	-> on("tipos");
		});

		Schema::create("personal", function(Blueprint $table) {
			$table -> id("idPersonal");

			$table -> string("numSegSocial", 11);
			$table -> string("puesto");

			$table
				-> foreign("idPersonal")
				-> references("idUsuario")
				-> on("usuarios");
		});

		Schema::create("alumnos", function(Blueprint $table) {
			$table -> id("idAlumno");

			$table -> date("fechaMatricula");

			$table
				-> foreign("idAlumno")
				-> references("idUsuario")
				-> on("usuarios");
		});

		Schema::create("cursos", function(Blueprint $table) {
			$table -> id("idCurso");

			$table -> string("nombre", 50);
			$table -> string("nombreCorto", 4);
			$table -> set("tipo", ["FPB", "CFGM", "CFGS", "FPCE"]);
			$table -> unsignedBigInteger("tutor", false);

			$table
				-> foreign("tutor")
				-> references("idPersonal")
				-> on("personal");
		});

		Schema::create("modulos", function(Blueprint $table) {
			$table -> unsignedBigInteger("idModulo", false);
			$table -> unsignedBigInteger("curso", false);

			$table -> string("nombre", 65);
			$table -> string("nombreCorto", 6);
			$table -> smallInteger("horas");
			$table -> unsignedBigInteger("profesor", false);

			$table -> primary(["idModulo", "curso"]);

			$table
				-> foreign("curso")
				-> references("idCurso")
				-> on("cursos");

			$table
				-> foreign("profesor")
				-> references("idPersonal")
				-> on("personal");
		});

		Schema::create("alumModul", function(Blueprint $table) {
			$table -> date("anho");
			$table -> unsignedBigInteger("curso", false);
			$table -> unsignedBigInteger("modulo", false);
			$table -> unsignedBigInteger("alumno", false);

			$table -> primary(["anho", "curso", "modulo", "alumno"]);

			$table
				-> foreign(["curso", "modulo"])
				-> references(["curso", "idModulo"])
				-> on("modulos");

			$table
				-> foreign("alumno")
				-> references("idAlumno")
				-> on("alumnos");
		});

		Schema::create("expedientes", function(Blueprint $table) {
			$table -> unsignedBigInteger("numero", false);
			$table -> unsignedBigInteger("alumno", false);
			$table -> unsignedBigInteger("curso", false);
			$table -> unsignedBigInteger("modulo", false);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists("expendientes");
		Schema::dropIfExists("alumModul");
		Schema::dropIfExists("modulos");
		Schema::dropIfExists("cursos");
		Schema::dropIfExists("alumnos");
		Schema::dropIfExists("personal");
		Schema::dropIfExists("usuarios");
		Schema::dropIfExists("tipos");
    }
};

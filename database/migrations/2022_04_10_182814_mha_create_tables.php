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
        Schema::create("usuarios", function(Blueprint $table) {
			$table -> id("id");

			$table -> string("dni", 9) -> unique();
			$table -> string("nombre", 25);
			$table -> string("apellidos", 35);
			// $table -> string("sexo", 6);

			$table -> string("direccion");		// ------------
			$table -> string("localidad");		//
			$table -> string("municipio");		// Cambiar los valores de los varchar
			$table -> string("provincia");		//
			$table -> string("codigoPostal");	//
			$table -> string("telefono"); 		// -------------
			$table -> date("fechaNacimiento");
			$table -> string("email") -> unique();
			$table -> binary("password"); // Cambiar de lugar
			$table -> boolean("activo") -> default(true);
			$table -> tinyInteger("nivel", false, true);
		});

		Schema::create("passwd", function(Blueprint $table) {
			$table -> unsignedBigInteger("id", true);
			$table -> unsignedBigInteger("usuario");
			$table -> binary("passwd");

			$table
				-> foreign("usuario")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("personal", function(Blueprint $table) {
			$table -> id("id");

			$table -> string("numSegSocial", 11);
			$table -> string("puesto");

			$table
				-> foreign("id")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("alumnos", function(Blueprint $table) {
			$table -> id("id");

			$table -> date("fechaMatricula");

			$table
				-> foreign("id")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("cursos", function(Blueprint $table) {
			$table -> id("id");

			$table -> string("nombre", 50);
			$table -> string("nombreCorto", 4);
			$table -> set("tipo", ["FPB", "CFGM", "CFGS", "FPCE"]);
			$table -> unsignedBigInteger("tutor", false);

			$table
				-> foreign("tutor")
				-> references("id")
				-> on("personal");
		});

		Schema::create("modulos", function(Blueprint $table) {
			$table -> unsignedBigInteger("id", false);
			$table -> unsignedBigInteger("curso", false);

			$table -> string("nombre", 65);
			$table -> string("nombreCorto", 6);
			$table -> string("nivel", 3);
			$table -> smallInteger("horas");
			$table -> unsignedBigInteger("profesor", false);

			$table -> primary(["id", "curso"]);

			$table
				-> foreign("curso")
				-> references("id")
				-> on("cursos");

			$table
				-> foreign("profesor")
				-> references("id")
				-> on("personal");
		});

		Schema::create("alumnoModulo", function(Blueprint $table) {
			$table -> date("anho");
			$table -> unsignedBigInteger("curso", false);
			$table -> unsignedBigInteger("modulo", false);
			$table -> unsignedBigInteger("alumno", false);

			$table -> primary(["anho", "curso", "modulo", "alumno"]);

			$table
				-> foreign(["curso", "modulo"])
				-> references(["curso", "id"])
				-> on("modulos");

			$table
				-> foreign("alumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("expedientes", function(Blueprint $table) {
			$table -> unsignedBigInteger("numero");
			$table -> unsignedBigInteger("alumno");

			$table -> primary("numero");

			$table
				-> foreign("alumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("lineasExpedientes", function(Blueprint $table) {
			$table -> unsignedBigInteger("expediente");
			$table -> unsignedBigInteger("linea");
			$table -> unsignedBigInteger("curso");
			$table -> unsignedBigInteger("modulo");
			$table -> set("periodo", [
				"General",
				"Evaluación Inicial",
				"1ª Evaluación",
				"2ª Evaluación",
				"1ª Convocatoria Final Ordinaria",
				"2ª Convocatoria Final Ordinaria",
				"1ª Convocatoria Final Extraordinaria",
				"2ª Convocatoria Final Extraordinaria"
			]);
			$table -> date("fecha");
			$table -> tinyInteger("calificacion");
			$table -> text("observaciones") -> nullable();

			$table -> primary(["expediente", "linea"]);

			$table
				-> foreign("expediente")
				-> references("numero")
				-> on("expedientes");

			$table
				-> foreign(["curso", "modulo"])
				-> references(["curso", "id"])
				-> on("modulos");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists("lineasExpedientes");
		Schema::dropIfExists("expedientes");
		Schema::dropIfExists("alumnoModulo");
		Schema::dropIfExists("modulos");
		Schema::dropIfExists("cursos");
		Schema::dropIfExists("alumnos");
		Schema::dropIfExists("personal");
		Schema::dropIfExists("passwd");
		Schema::dropIfExists("usuarios");
    }
};

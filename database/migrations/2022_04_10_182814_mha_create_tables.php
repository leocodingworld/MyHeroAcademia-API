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

			$table -> string("dni", 9);
			$table -> string("nombre", 25);
			$table -> string("apellidos", 35);
			$table -> string("direccion");		// ------------
			$table -> string("localidad");		//
			$table -> string("municipio");		// Cambiar los valores de los varchar
			$table -> string("provincia");		//
			$table -> string("codigoPostal");	//
			$table -> string("telefono"); 		// -------------
			$table -> string("fechaNacimiento", 10);
			$table -> string("email");
			$table -> binary("password"); // Cambiar de lugar
			$table -> boolean("activo") -> default(false);
			$table -> tinyInteger("nivel", false, true);
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

		Schema::create("alumModul", function(Blueprint $table) {
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

		/**
		 * Queda Pendiente de revisar. Falta el poner notas y observaciones
		 */
		Schema::create("expedientes", function(Blueprint $table) {
			$table -> unsignedBigInteger("numero", false);
			$table -> unsignedBigInteger("alumno", false);
			$table -> unsignedBigInteger("curso", false);
			$table -> unsignedBigInteger("modulo", false);
			$table -> set("periodo", [
				"1a Evaluación",
				"2a Evaluación",
				"3a Evaluación",
				"Final Ordinaria",
				"Primera Convocatoria"
			]);
			$table -> string("observaciones");

			$table -> primary([
				"numero",
				"alumno",
				"curso",
				"modulo",
				"periodo",
				"observaciones"
			], "pk");

			$table
				-> foreign("alumno")
				-> references("id")
				-> on("alumnos");

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
		Schema::dropIfExists("expedientes");
		Schema::dropIfExists("alumModul");
		Schema::dropIfExists("modulos");
		Schema::dropIfExists("cursos");
		Schema::dropIfExists("alumnos");
		Schema::dropIfExists("personal");
		Schema::dropIfExists("usuarios");
    }
};

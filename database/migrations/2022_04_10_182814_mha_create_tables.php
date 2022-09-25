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
			$table -> unsignedInteger("id", true);

			$table -> string("dni", 9) -> unique("dniUnique");
			$table -> string("nombre", 25);
			$table -> string("apellidos", 35);
			$table -> string("sexo", 6);
			$table -> string("direccion", 100);
			$table -> string("localidad", 40);
			$table -> string("municipio", 30);
			$table -> string("provincia", 30);
			$table -> string("codigoPostal", 5);
			$table -> string("telefono", 20);
			$table -> date("fechaNacimiento");
			$table -> string("email") -> unique("emailUnique");
			$table -> string("nivel", 1);
			$table -> binary("password");
			$table -> boolean("activo") -> default(true);
		});

		Schema::create("personal", function(Blueprint $table) {
			$table -> unsignedInteger("id");

			$table -> string("numSegSocial", 11);
			$table -> string("puesto");

			$table
				-> foreign("id")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("alumnos", function(Blueprint $table) {
			$table -> unsignedInteger("id");

			$table -> boolean("matriculado") -> default(true);
			$table -> string("anho", 9) -> nullable();

			$table
				-> foreign("id")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("cursos", function(Blueprint $table) {
			$table -> unsignedInteger("id");

			$table -> string("nombre", 50);
			$table -> string("nombreCorto", 4);
			$table -> string("tipo", 35);
			$table -> string("nivel", 3);
			$table -> unsignedInteger("tutor") -> nullable();

			$table -> primary("id");

			$table
				-> foreign("tutor")
				-> references("id")
				-> on("personal");
		});

		Schema::create("modulos", function(Blueprint $table) {
			$table -> unsignedInteger("id");
			$table -> unsignedInteger("idCurso");

			$table -> string("nombre", 65);
			$table -> string("nombreCorto", 6);
			$table -> smallInteger("horas");
			$table -> unsignedInteger("tutor") -> nullable();

			$table -> primary(["id", "idCurso"], "pk_modulo_curso");

			$table
				-> foreign("idCurso", "fk_ModuloCurso")
				-> references("id")
				-> on("cursos");

			$table
				-> foreign("tutor", "fk_PersonalProfesor")
				-> references("id")
				-> on("personal");
		});

		Schema::create("listados", function(Blueprint $table) {
			$table -> unsignedInteger("idCurso");
			$table -> unsignedInteger("idModulo");
			$table -> unsignedInteger("idAlumno");

			$table -> primary(["idCurso", "idModulo", "idAlumno"]);

			$table
				-> foreign(["idCurso", "idModulo"], "fk_ListadosModuloCurso")
				-> references(["idCurso", "id"])
				-> on("modulos");

			$table
				-> foreign("idAlumno", "fk_ListadosAlumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("notas", function(Blueprint $table) {
			$table -> unsignedInteger("referencia", true);

			$table -> unsignedInteger("idAlumno");
			$table -> unsignedInteger("idCurso");
			$table -> unsignedInteger("idModulo");
			$table -> string("periodo");
			$table -> unsignedTinyInteger("calificacion");
			$table -> text("observaciones") -> nullable();

			$table
				-> foreign("idAlumno", "fk_alumno")
				-> references("id")
				-> on("alumnos");

			$table
				-> foreign("idCurso", "fk_curso")
				-> references("id")
				-> on("cursos");

			$table
				-> foreign("idModulo", "fk_modulo")
				-> references("id")
				-> on("modulos");
		});

		Schema::create("expedientes", function(Blueprint $table) {
			$table -> unsignedInteger("numero", true);
			$table -> unsignedInteger("idAlumno");

			$table
				-> foreign("idAlumno", "fk_alumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("lineasExpedientes", function(Blueprint $table) {
			$table -> unsignedInteger("numExpediente");
			$table -> unsignedInteger("linea");
			$table -> string("anho", 9);
			$table -> unsignedInteger("idCurso");
			$table -> unsignedInteger("idModulo");
			$table -> string("convocatoria", 14);
			$table -> tinyInteger("calificacion") -> nullable();
			$table -> text("observaciones") -> nullable();

			$table -> primary(["numExpediente", "linea"]);

			$table
				-> foreign("numExpediente", "fk_expediente")
				-> references("numero")
				-> on("expedientes");

			$table
				-> foreign(["idCurso", "idModulo"], "fk_moduloCurso")
				-> references(["idCurso", "id"])
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
		Schema::dropIfExists("notas");
		Schema::dropIfExists("listados");
		Schema::dropIfExists("modulos");
		Schema::dropIfExists("cursos");
		Schema::dropIfExists("alumnos");
		Schema::dropIfExists("personal");
		Schema::dropIfExists("usuarios");
    }
};

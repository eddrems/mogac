<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRrhhPersonaEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_persona_estado', function (Blueprint $table) {
            $table->bigInteger('id_persona_estado')->unsigned()->primary();
            $table->string('denominacion', 250);
            $table->tinyInteger('permite_inicio_sesion');
            $table->string('css_class', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rrhh_persona_estado');
    }
}

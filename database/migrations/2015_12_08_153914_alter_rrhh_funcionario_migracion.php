<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRrhhFuncionarioMigracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rrhh_funcionario', function (Blueprint $table) {
            $table->tinyInteger('migrado')->nullable();
            $table->bigInteger('id_persona')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rrhh_funcionario', function (Blueprint $table) {
            $table->dropColumn('migrado');
            $table->dropColumn('id_persona');
        });
    }
}

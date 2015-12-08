<?php

use Illuminate\Database\Seeder;

class migrar_rrhh_funcionario_a_rrhh_persona_fixes_previo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rrhh_funcionario')
            ->where('id_funcionario', 4876)
            ->update(['identificacion' => '0908948110-']);
    }
}

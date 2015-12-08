<?php

use Illuminate\Database\Seeder;

class add_data_rrhh_persona_estado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rrhh_persona_estado')->insert([
            'id_persona_estado' => 1,
            'denominacion' => 'Activo',
            'permite_inicio_sesion' => 1,
            'css_class' => 'success'
        ]);
        DB::table('rrhh_persona_estado')->insert([
            'id_persona_estado' => 2,
            'denominacion' => 'Suspension Temporal',
            'permite_inicio_sesion' => 0,
            'css_class' => 'important'
        ]);
        DB::table('rrhh_persona_estado')->insert([
            'id_persona_estado' => 3,
            'denominacion' => 'Suspendido',
            'permite_inicio_sesion' => 0,
            'css_class' => 'important'
        ]);
    }
}

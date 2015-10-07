<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divieAula extends Model {


    protected $table = 'div_ie_aula';
    protected $primaryKey = 'id_aula';
    public $timestamps = false;



    //dependencias
    public function institucion()
    {
        return $this->belongsTo('App\Models\divInstitucionEducativa', 'id_institucion_educativa');
    }


    public function mobiliario()
    {
        return $this->hasMany('App\Models\divieMobiliario', 'id_aula');
    }

    public function oferta_educativa_aula()
    {
        return $this->hasMany('App\Models\acadOfertaEductaivaAula', 'id_aula');
    }


}





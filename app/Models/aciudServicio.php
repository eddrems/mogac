<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudServicio extends Model {

    protected $table = 'aciud_cat_servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;



    public function casos()
    {
        return $this->hasMany('App\Models\aciudCaso', 'id_servicio');
    }


}


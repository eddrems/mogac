<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divProvincia extends Model {


    protected $table = 'div_provincia';
    protected $primaryKey = 'id_provincia';
    public $timestamps = false;


    public function ciudades()
    {
        return $this->hasMany('App\Models\divCiudad', 'id_provincia');
    }


}




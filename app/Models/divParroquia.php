<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divParroquia extends Model {


    protected $table = 'div_parroquia';
    protected $primaryKey = 'id_parroquia';
    public $timestamps = false;


    public function ciudad()
    {
        return $this->belongsTo('App\Models\divCiudad', 'id_ciudad');
    }


}




<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class snapServicio extends Model {

    protected $table = 'snap_servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;



    public function casos()
    {
        return $this->hasMany('App\Models\snapCaso', 'id_servicio');
    }


}


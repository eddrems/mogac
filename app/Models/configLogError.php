<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configLogError extends Model {

    protected $table = 'config_log_error';
    protected $primaryKey = 'id_log_error';
    public $timestamps = false;




    public function funcionario()
    {
        return $this->belongsTo('rApp\Models\rhhFuncionario', 'if_funcionario', 'id_funcionario' );
    }


}

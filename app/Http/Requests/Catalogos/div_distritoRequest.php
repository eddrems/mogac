<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class div_distritoRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'id_zona' => 'required',
            'codigoSemplades' => 'required',
            'denominacion' => 'required',
            'denominacion_institucional' => 'required',
            'id_parroquia' => 'required',
            'direccion' => 'required'

        ];
    }


}

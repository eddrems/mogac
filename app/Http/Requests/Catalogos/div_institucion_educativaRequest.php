<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class div_institucion_educativaRequest extends Request {

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
            'id_circuito' => 'required',
            'codigo_amie' => 'required',
            'denominacion' => 'required',
            'id_parroquia' => 'required'
        ];
    }


}

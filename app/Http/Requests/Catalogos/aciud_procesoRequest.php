<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class aciud_procesoRequest extends Request {

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
            'id_departamento' => 'required|numeric',
            'id_caso' => 'required|numeric',
            'denominacion' => 'required',
            'base_legal' => 'required',
            'proposito' => 'required',
            'tiempo' => 'required|numeric',
            'requiere_caso_snap' => 'required',
            'incluir_matriz_snap' => 'required',
            'activo_recepcion' => 'required'
        ];
    }


}

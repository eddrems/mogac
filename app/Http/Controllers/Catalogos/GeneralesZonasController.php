<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\divZonaRepository as repoZonas;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class GeneralesZonasController extends Controller {


    private $repo_main;

    public function __construct(repoZonas $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('catalogos.gen_zonas.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('codigoSemplades',function($model)
            {
                return $model->codigoSemplades;
            })
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('denominacion_institucional',function($model)
            {
                return $model->denominacion_institucional;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/zonas/editar') .'/'. Crypt::encrypt($model->id_zona) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/zonas/eliminar') .'/'. Crypt::encrypt($model->id_zona) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'codigoSemplades',
                'denominacion',
                'denominacion_institucional',
                'composicion'
            )
            ->orderColumns(
                'codigoSemplades',
                'denominacion',
                'denominacion_institucional',
                'composicion'
            )
            ->make();
    }


    public function crear()
    {


        return view('catalogos.gen_zonas.crear');
    }

    public function grabar_nuevo(Requests\Catalogos\div_zonaRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/zonas');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/zonas/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));


        return view('catalogos.gen_zonas.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_zonaRequest  $request)
    {
        if($this->repo_main->update($request->only(['codigoSemplades','denominacion','denominacion_institucional','composicion','logo_certificacion','numero_certificacion','pie_pagina_certificacion','logo_top','logo_left','numero_top','numero_width','logo_scale']), Crypt::decrypt($request->id), 'id_zona'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/zonas/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/zonas/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.gen_zonas.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/zonas');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/zonas/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








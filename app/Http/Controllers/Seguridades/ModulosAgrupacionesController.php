<?php namespace App\Http\Controllers\Seguridades;


use App\Repositories\configModuloSubsistemaRepository as repoModuloSub;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class ModulosAgrupacionesController extends Controller {


    private $repo_main;

    public function __construct(repoModuloSub $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('seguridades.modulos_agrupacion.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('orden',function($model)
            {
                return $model->orden;
            })
            ->addColumn('descripcion',function($model)
            {
                return $model->descripcion;
            })
            ->addColumn('esta_activo',function($model)
            {
                if ($model->esta_activo == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('icon',function($model)
            {
                return '<i class="' . $model->icon . '"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('seguridades/modulos/editar') .'/'. Crypt::encrypt($model->id_subsistema) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('seguridades/modulos/eliminar') .'/'. Crypt::encrypt($model->id_subsistema) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '<a href="' . url('seguridades/modulos/detalles/listar') .'/'. Crypt::encrypt($model->id_subsistema) .'" class="btn btn-warning btn-xs btn-mini"><i class="fa fa-bars"></i> modulos</a>'
                . '</div>';
            })
            ->searchColumns(
                'descripcion',
                'icon'
            )
            ->orderColumns(
                'descripcion',
                'icon'
            )
            ->make();
    }


    public function crear()
    {


        return view('seguridades.modulos_agrupacion.crear');
    }

    public function grabar_nuevo(Requests\Seguridades\config_modulosubsistemaRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/modulos');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/modulos/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));


        return view('seguridades.modulos_agrupacion.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Seguridades\config_modulosubsistemaRequest  $request)
    {
        if($this->repo_main->update($request->only(['descripcion', 'esta_activo', 'orden', 'icon']), Crypt::decrypt($request->id), 'id_subsistema'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/modulos/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/modulos/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('seguridades.modulos_agrupacion.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/modulos');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('seguridades/modulos/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








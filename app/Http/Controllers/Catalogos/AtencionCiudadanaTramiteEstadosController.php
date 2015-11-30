<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\aciudEstadoTramiteRepository as repoEstados;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class AtencionCiudadanaTramiteEstadosController extends Controller {


    private $repo_main;

    public function __construct(repoEstados $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('catalogos.ac_tramite_estados.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('orden',function($model)
            {
                return $model->orden;
            })
            ->addColumn('denominacion',function($model)
            {
                return $model->letra . ': ' . $model->denominacion;
            })
            ->addColumn('css_color',function($model)
            {
                return $model->css_color . ' | ' . $model->css_label_class;
            })
            ->addColumn('permite_edicion',function($model)
            {
                if ($model->permite_edicion == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('proceso_terminado',function($model)
            {
                if ($model->proceso_terminado == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('permite_cambio_manual',function($model)
            {
                if ($model->permite_cambio_manual == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('permite_traslado_distrito',function($model)
            {
                if ($model->permite_traslado_distrito == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/tramites_estado/editar') .'/'. Crypt::encrypt($model->id_estado_tramite) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/tramites_estado/eliminar') .'/'. Crypt::encrypt($model->id_estado_tramite) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'id_estado_tramite',
                'orden',
                'denominacion',
                'css_color',
                'css_label_class',
                'letra',
                'permite_edicion',
                'proceso_terminado',
                'permite_cambio_manual',
                'permite_traslado_distrito'
            )
            ->orderColumns(
                'id_estado_tramite',
                'orden',
                'denominacion',
                'css_color',
                'css_label_class',
                'letra',
                'permite_edicion',
                'proceso_terminado',
                'permite_cambio_manual',
                'permite_traslado_distrito'
            )
            ->make();
    }


    public function crear()
    {


        return view('catalogos.ac_tramite_estados.crear');
    }

    public function grabar_nuevo(Requests\Catalogos\aciud_estado_tramiteRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/tramites_estado');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/tramites_estado/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));


        return view('catalogos.ac_tramite_estados.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\aciud_estado_tramiteRequest  $request)
    {
        if($this->repo_main->update($request->only(['orden', 'denominacion', 'css_color', 'css_label_class', 'letra', 'permite_edicion', 'proceso_terminado', 'permite_cambio_manual','permite_traslado_distrito']), Crypt::decrypt($request->id), 'id_estado_tramite'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/tramites_estado/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/tramites_estado/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.ac_tramite_estados.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/tramites_estado');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/tramites_estado/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








<?php namespace App\Http\Controllers\Catalogos;

use App\Repositories\aciudProcesoRepository as repoProcesos;
use App\Repositories\aciudCasoRepository as repoCasos;
use App\Repositories\rrhhDepartamentoRepository as repoDepa;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class AtencionCiudadanaProcesosController extends Controller {


    private $repo_procesos;
    private $repo_casos;
    private $repo_departamentos;

    public function __construct(repoProcesos $repo_procesos, repoCasos $repo_casos, repoDepa $repo_departamentos) {

        $this->repo_procesos = $repo_procesos;
        $this->repo_casos = $repo_casos;
        $this->repo_departamentos = $repo_departamentos;
    }



    public function index()
    {
        return view('catalogos.ac_procesos.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_procesos->buscar_todos_dt())
            ->addColumn('caso',function($model)
            {
                return  $model->servicio  . '<br><small class="text-uc text-xs text-muted"><i class="fa fa-folder"></i> ' . $model->caso . '</small>';
            })
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion .  '<br><small class="text-uc text-xs text-muted"><i class="fa fa-home"></i> ' . $model->departamento . '</small>';;
            })
            ->addColumn('tiempo',function($model)
            {
                return $model->tiempo;
            })
            ->addColumn('activo_recepcion',function($model)
            {
                if ($model->activo_recepcion == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('incluir_matriz_snap',function($model)
            {
                if ($model->incluir_matriz_snap == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/procesos_ac/editar') .'/'. Crypt::encrypt($model->id_proceso) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/procesos_ac/eliminar') .'/'. Crypt::encrypt($model->id_proceso) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'aciud_cat_servicio.denominacion',
                'aciud_cat_caso.denominacion',
                'rrhh_departamento.denominacion',
                'aciud_proceso.id_proceso',
                'aciud_proceso.denominacion',
                'aciud_proceso.tiempo',
                'aciud_proceso.activo_recepcion',
                'aciud_proceso.incluir_matriz_snap'
            )
            ->orderColumns(
                'aciud_cat_caso.denominacion',
                'aciud_proceso.id_proceso',
                'aciud_proceso.denominacion',
                'aciud_proceso.tiempo',
                'aciud_proceso.activo_recepcion',
                'aciud_proceso.incluir_matriz_snap'
            )
            ->make();
    }


    public function crear()
    {

        $id_departamento = $this->repo_departamentos->lists('denominacion', 'id_departamento');
        $id_caso = $this->repo_casos->generar_lista_con_servicio();

        return view('catalogos.ac_procesos.crear', ['id_departamento' => $id_departamento, 'id_caso' => $id_caso]);
    }

    public function grabar_nuevo(Requests\Catalogos\aciud_procesoRequest $request)
    {
        if($this->repo_procesos->create($request->all()))
        {
            Toastr::success($this->repo_procesos->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/procesos_ac');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/procesos_ac/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_procesos->find(Crypt::decrypt($id));

        $id_departamento = $this->repo_departamentos->lists('denominacion', 'id_departamento');
        $id_caso = $this->repo_casos->generar_lista_con_servicio_seleccion($registro->id_caso);

        return view('catalogos.ac_procesos.editar', ['id_departamento' => $id_departamento, 'id_caso' => $id_caso])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\aciud_procesoRequest  $request)
    {
        if($this->repo_procesos->update($request->only(['id_departamento','id_caso','denominacion','base_legal','proposito','tiempo','requiere_caso_snap','incluir_matriz_snap','activo_recepcion']), Crypt::decrypt($request->id), 'id_proceso'))
        {
            Toastr::success($this->repo_procesos->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/procesos_ac/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/procesos_ac/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_procesos->find(Crypt::decrypt($id));

        return view('catalogos.ac_procesos.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_procesos->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_procesos->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/procesos_ac');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/procesos_ac/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








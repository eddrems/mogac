<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\aciudCasoRepository as repoCasos;
use App\Repositories\aciudServicioRepository as repoServicios;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class AtencionCiudadanaCasosController extends Controller {


    private $repo_servicios;
    private $repo_casos;

    public function __construct(repoServicios $repo_servicios, repoCasos $repo_casos) {

        $this->repo_servicios = $repo_servicios;
        $this->repo_casos = $repo_casos;
    }



    public function index()
    {
        return view('catalogos.ac_casos.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_casos->buscar_todos_dt())
            ->addColumn('servicio',function($model)
            {
                return  $model->servicio;
            })
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/casos_ac/editar') .'/'. Crypt::encrypt($model->id_caso) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/casos_ac/eliminar') .'/'. Crypt::encrypt($model->id_caso) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'aciud_cat_servicio.denominacion',
                'aciud_cat_caso.id_caso',
                'aciud_cat_caso.denominacion'
            )
            ->orderColumns(
                'aciud_cat_servicio.denominacion',
                'aciud_cat_caso.id_caso',
                'aciud_cat_caso.denominacion'
            )
            ->make();
    }


    public function crear()
    {

        $id_servicio = $this->repo_servicios->lists('denominacion', 'id_servicio');

        return view('catalogos.ac_casos.crear', ['id_servicio' => $id_servicio]);
    }

    public function grabar_nuevo(Requests\Catalogos\aciud_cat_casoRequest $request)
    {
        if($this->repo_casos->create($request->all()))
        {
            Toastr::success($this->repo_casos->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/casos_ac');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/casos_ac/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_casos->find(Crypt::decrypt($id));

        $id_servicio = $this->repo_servicios->lists('denominacion', 'id_servicio');

        return view('catalogos.ac_casos.editar', ['id_servicio' => $id_servicio])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\aciud_cat_casoRequest  $request)
    {
        if($this->repo_casos->update($request->only(['id_servicio', 'denominacion']), Crypt::decrypt($request->id), 'id_caso'))
        {
            Toastr::success($this->repo_casos->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/casos_ac');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/casos_ac/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_casos->find(Crypt::decrypt($id));

        return view('catalogos.ac_casos.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_casos->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_casos->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/casos_ac');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/casos_ac/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








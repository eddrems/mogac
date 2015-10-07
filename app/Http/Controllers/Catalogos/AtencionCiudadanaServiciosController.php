<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\aciudServicioRepository as repoServicios;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class AtencionCiudadanaServiciosController extends Controller {


    private $repo_servicios;

    public function __construct(repoServicios $repo_servicios) {

        $this->repo_servicios = $repo_servicios;
    }



    public function index()
    {
        return view('catalogos.ac_servicios.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_servicios->buscar_todos_dt())
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/servicios_ac/editar') .'/'. Crypt::encrypt($model->id_servicio) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/servicios_ac/eliminar') .'/'. Crypt::encrypt($model->id_servicio) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'denominacion'
            )
            ->orderColumns(
                'denominacion'
            )
            ->make();
    }


    public function crear()
    {


        return view('catalogos.ac_servicios.crear');
    }

    public function grabar_nuevo(Requests\Catalogos\aciud_cat_servicioRequest $request)
    {
        if($this->repo_servicios->create($request->all()))
        {
            Toastr::success($this->repo_servicios->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/servicios_ac');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/servicios_ac/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_servicios->find(Crypt::decrypt($id));


        return view('catalogos.ac_servicios.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\aciud_cat_servicioRequest  $request)
    {
        if($this->repo_servicios->update($request->only(['denominacion']), Crypt::decrypt($request->id), 'id_servicio'))
        {
            Toastr::success($this->repo_servicios->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/servicios_ac');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/servicios_ac/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_servicios->find(Crypt::decrypt($id));

        return view('catalogos.ac_servicios.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_servicios->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_servicios->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/servicios_ac');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/servicios_ac/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








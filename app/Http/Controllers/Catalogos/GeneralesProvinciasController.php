<?php namespace App\Http\Controllers\Catalogos;


use App\Models\divProvincia;
use App\Repositories\divProvinciaRepository as repoProvincia;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class GeneralesProvinciasController extends Controller {


    private $repo_main;

    public function __construct(repoProvincia $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('catalogos.lg_provincias.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('codigo',function($model)
            {
                return $model->codigo;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/provincias/editar') .'/'. Crypt::encrypt($model->id_provincia) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/provincias/eliminar') .'/'. Crypt::encrypt($model->id_provincia) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '<a href="' . url('catalogos/ciudades/listar') .'/'. Crypt::encrypt($model->id_provincia) .'" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-bars"></i> ciudades</a>'
                . '</div>';
            })
            ->searchColumns(
                'denominacion',
                'codigo'
            )
            ->orderColumns(
                'denominacion',
                'codigo'
            )
            ->make();
    }


    public function crear()
    {


        return view('catalogos.lg_provincias.crear');
    }

    public function grabar_nuevo(Requests\Catalogos\div_provinciaRequest $request)
    {
        $last_id = divProvincia::max('id_provincia');
        $last_id++;

        if($this->repo_main->create(['id_provincia' => $last_id, 'denominacion' => $request->denominacion, 'codigo' => $request->codigo]))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/provincias');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/provincias/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));


        return view('catalogos.lg_provincias.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_provinciaRequest  $request)
    {
        if($this->repo_main->update($request->only(['denominacion', 'codigo']), Crypt::decrypt($request->id), 'id_provincia'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/provincias/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/provincias/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.lg_provincias.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/provincias');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/provincias/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








<?php namespace App\Http\Controllers\Catalogos;


use App\Models\divCiudad;
use App\Repositories\divProvinciaRepository as repoProvincia;
use App\Repositories\divCiudadRepository as repoCiudadas;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class GeneralesCiduadesController extends Controller {


    private $repo_main;
    private $repo_ciudades;

    public function __construct(repoProvincia $repo_ciudades,repoCiudadas$repo_main) {

        $this->repo_main = $repo_main;
        $this->repo_ciudades = $repo_ciudades;
    }



    public function index($id_provincia)
    {
        $provincia = $this->repo_ciudades->find(Crypt::decrypt($id_provincia));
        
        return view('catalogos.lg_ciudades.index', ['provincia' => $provincia]);
    }

    public function buscar_registros_dt($id_provincia)
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt($id_provincia))
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
                . '<a href="' . url('catalogos/ciudades/editar') .'/'. Crypt::encrypt($model->id_ciudad) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/ciudades/eliminar') .'/'. Crypt::encrypt($model->id_ciudad) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '<a href="' . url('catalogos/parroquias/listar') .'/'. Crypt::encrypt($model->id_ciudad) .'" class="btn btn-warning  btn-xs btn-mini"><i class="fa fa-bars"></i> parroquias</a>'
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


    public function crear($id_provincia)
    {
        $provincia = $this->repo_ciudades->find(Crypt::decrypt($id_provincia));

        return view('catalogos.lg_ciudades.crear', ['provincia' => $provincia]);
    }

    public function grabar_nuevo(Requests\Catalogos\div_ciudadRequest $request)
    {
        $last_id = divCiudad::max('id_ciudad');
        $last_id++;

        if($this->repo_main->create(['id_ciudad' => $last_id, 'id_provincia' => $request->id_provincia, 'denominacion' => $request->denominacion, 'codigo' => $request->codigo]))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/ciudades/listar/' . Crypt::encrypt($request->id_provincia));
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/ciudades/crear/' . Crypt::encrypt($request->id_provincia))->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $provincia = $this->repo_ciudades->find($registro->id_provincia);


        return view('catalogos.lg_ciudades.editar', ['provincia' => $provincia])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_ciudadRequest  $request)
    {
        if($this->repo_main->update($request->only(['denominacion', 'codigo']), Crypt::decrypt($request->id), 'id_ciudad'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/ciudades/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/ciudades/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $provincia = $this->repo_ciudades->find($registro->id_provincia);


        return view('catalogos.lg_ciudades.eliminar', ['provincia' => $provincia])->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/ciudades/listar'.'/'.$request->id_provincia);
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/ciudades/'.'/'.$request->id)->withInput();
        }
    }







}








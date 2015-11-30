<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\divCircuitoRepository as repoCircuitos;
use App\Repositories\divParroquiaRepository as repoParroquias;
use App\Repositories\divInstitucionEducativaRepository as repoIEs;


use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Repositories\CriteriosConsulta\Generales\ZonasOrdenAsc;

use Toastr;
use Crypt;


use Illuminate\Http\Request;




class GeneralesInsticionesEducativasController extends Controller {


    private $repo_main;
    private $repo_parroquias;
    private $repo_circuitos;

    public function __construct(repoIEs $repo_main, repoParroquias $repo_parroquias, repoCircuitos $repo_circuitos) {

        $this->repo_main = $repo_main;
        $this->repo_parroquias = $repo_parroquias;
        $this->repo_circuitos = $repo_circuitos;
    }



    public function index()
    {
        return view('catalogos.gen_ies.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('codigo_amie',function($model)
            {
                return $model->codigo_amie;
            })
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('ubicacion',function($model)
            {
                return '<small class="text-muted text-xs">' . $model->ubicacion . '<br>' . $model->ubicacion2 . '</small>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/ies/editar') .'/'. Crypt::encrypt($model->id_institucion_educativa) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/ies/eliminar') .'/'. Crypt::encrypt($model->id_institucion_educativa) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'id_institucion_educativa',
                'codigo_amie',
                'div_institucion_educativa.denominacion',
                'div_distrito.denominacion',
                'div_circuito.codigoSemplades',
                'div_zona.denominacion',
                'div_ciudad.denominacion'
            )
            ->orderColumns(
                'codigo_amie',
                'id_institucion_educativa',
                'div_institucion_educativa.denominacion'
            )
            ->make();
    }


    public function crear()
    {
        $parroquias = $this->repo_parroquias->bucar_parroquias_ruta_completa();
        $circuitos = $this->repo_circuitos->generar_lista_con_agrupador_distritos();

        return view('catalogos.gen_ies.crear', ['parroquias' => $parroquias, 'circuitos' => $circuitos]);
    }

    public function grabar_nuevo(Requests\Catalogos\div_institucion_educativaRequest $request)
    {

        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/ies');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/ies/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $parroquias = $this->repo_parroquias->bucar_parroquias_ruta_completa();
        $circuitos = $this->repo_circuitos->generar_lista_con_agrupador_distritos();
        $zonas = $this->repo_zonas->pushCriteria(new ZonasOrdenAsc())->lists('denominacion_institucional', 'id_zona');


        return view('catalogos.gen_ies.editar', ['parroquias' => $parroquias, 'circuitos' => $circuitos, 'zonas' => $zonas])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_distritoRequest  $request)
    {
        if($this->repo_main->update($request->only(['id_zona', 'codigoSemplades', 'denominacion', 'denominacion_institucional', 'composicion', 'id_parroquia', 'id_circuito', 'direccion']), Crypt::decrypt($request->id), 'id_distrito'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/ies/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/ies/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.gen_ies.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/ies');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/ies/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








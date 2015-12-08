<?php namespace App\Http\Controllers\Usuarios;


use App\Repositories\rrhhCargoRepository as repoCargos;
use App\Repositories\rrhhTipoIdentificacionRepository as repoTipIdentificacion;
use App\Repositories\rrhhFuncionarioGeneroRepository as repoGeneros;
use App\Repositories\rrhhDepartamentoRepository as repoDepartamentos;
use App\Repositories\rrhhFuncionarioRepository as repoFuncionarios;
use App\Repositories\rrhhTipoFuncionarioRepository as repoTiposFuncionarios;
use App\Repositories\divZonaRepository as repoZonas;
use App\Repositories\divDistritoRepository as repoDistritos;


use App\Repositories\CriteriosConsulta\Usuarios\DepartamentosPorTipoUsuario;
use App\Repositories\CriteriosConsulta\Usuarios\CargosPorTipoUsuario;
use App\Repositories\CriteriosConsulta\Generales\ZonasOrdenAsc as divOrdAsc;
use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;
use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;



class GestionUsuariosController extends Controller {


    private $repo_main;
    private $repo_tident;
    private $repo_generos;
    private $repo_tipofuncionarios;
    private $repo_deptos;
    private $repo_cargos;
    private $repo_zonas;
    private $repo_distritos;

    public function __construct(repoFuncionarios $repo_main, repoTipIdentificacion $repo_tident, repoGeneros $repo_generos, repoTiposFuncionarios $repo_tipofuncionarios, repoDepartamentos $repo_deptos, repoCargos $repo_cargos, repoZonas $repo_zonas, repoDistritos $repo_distritos) {

        $this->repo_main = $repo_main;
        $this->repo_tident = $repo_tident;
        $this->repo_generos = $repo_generos;
        $this->repo_tipofuncionarios = $repo_tipofuncionarios;
        $this->repo_deptos = $repo_deptos;
        $this->repo_cargos = $repo_cargos;
        $this->repo_zonas = $repo_zonas;
        $this->repo_distritos = $repo_distritos;
    }



    public function index()
    {
        return view('usuarios.gestion.index');
    }

    public function buscar_registros_dt($criterio)
    {
        $resultados  = $this->repo_main->buscar_todos_dt($criterio);

        return $resultados;
    }


    public function buscar_dependencias_nu()
    {
        $tipoa_func = $this->repo_tipofuncionarios->all(['id_tipo_funcionario', 'denominacion']);
        $tipos_ident = $this->repo_tident->all(['id_tipo_identificacion', 'denominacion']);
        $generos = $this->repo_generos->all(['id_genero', 'denominacion']);
        return response()->json(['resultado' => 'ok', 'tip_func' => $tipoa_func, 'tip_ident' => $tipos_ident, 'generos' => $generos ]);
    }

    public function buscar_dependencias_nu_por_tipo_funcionario($id_tipo_funcionario)
    {
        $dptos = $this->repo_deptos->pushCriteria(new DepartamentosPorTipoUsuario($id_tipo_funcionario))->all(['id_departamento', 'denominacion']);
        $cargos = $this->repo_cargos->pushCriteria(new CargosPorTipoUsuario($id_tipo_funcionario))->all(['id_cargo', 'denominacion']);

        switch($id_tipo_funcionario)
        {
            case 1:
                $distritos = $this->repo_distritos->pushCriteria(new divOrdAsc())->all(['id_distrito', 'denominacion_institucional']);
                return response()->json(['resultado' => 'ok', 'dptos' => $dptos, 'cargos' => $cargos, 'distritos' => $distritos ]);
                break;
            case 2:
                $zonas = $this->repo_zonas->pushCriteria(new divOrdAsc())->all(['id_zona', 'denominacion_institucional']);
                return response()->json(['resultado' => 'ok', 'dptos' => $dptos, 'cargos' => $cargos, 'zonas' => $zonas ]);
                break;
            case 3:
                return response()->json(['resultado' => 'ok', 'dptos' => $dptos, 'cargos' => $cargos ]);
                break;


        }
    }



}








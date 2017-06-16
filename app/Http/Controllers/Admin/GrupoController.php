<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\Curso;
use App\Grupo;
use App\GrupoCurso;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Relations\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acceso = Acceso::acceso_auth();
        $grupos = Grupo::facultadSede()->sortBy('wgrupo');
        return view('admin.grupo.index')
            ->with('grupos', $grupos)
            ->with('acceso_auth',$acceso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.grupo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = new Grupo();
        $grupo->facultad_id = Session::get('facultad_id');
        $grupo->sede_id = Session::get('sede_id');
        $grupo->cgrupo = $request->cgrupo;
        $grupo->wgrupo = $request->wgrupo;
        $grupo->save();
        Flash::success('Se ha registrado '.$grupo->wgrupo.' de forma exitosa');
        return redirect()->route('administrador.grupo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('errors.000');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::find($id);
        return view('admin.grupo.edit')
            ->with('grupo',$grupo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $grupo = Grupo::find($request->id);
        $grupo->cgrupo = $request->cgrupo;
        $grupo->wgrupo = $request->wgrupo;
        $grupo->save();

        Flash::warning('Se ha modificado el registro: '.$grupo->id.' : '.$grupo->wgrupo.' de forma exitosa');
        return redirect()->route('administrador.grupo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = Grupo::find($id);
        $grupo->delete();          
        Flash::error('Se ha eliminado el registro: '.$grupo->id.' '.$grupo->wgrupo.' de forma exitosa');
        return redirect()->route('administrador.grupo.index');
    }

    public function editcursos($id)
    {
        $grupo = Grupo::find($id);
        $cursos = Grupo::find($id)->GrupoCursos()->get();
        /***********************************************************************************/
        /* Datos para el CHOSEN inferior */
        /* Crea el array para el CHOSEN select multiple  */
        $ch_cursos = $cursos->lists('curso_id')->toArray();
//dd($ch_cursos);
        /* Crea la lista de cursos */
        $xcursos = Curso::all();
//dd($xcursos);
        $xcursos->each(function($xcursos){
            $xcursos->curso;
            $xcursos->wwcurso = $xcursos->wcurso." (".$xcursos->ccurso.")";
        });
//    dd($xcursos);
        $lcursos = $xcursos->lists('wwcurso','id');
//dd($lcursos);
        /***********************************************************************************/
        return view('admin.grupos.editcursos')
            ->with('grupo', $grupo)
            ->with('cursos',$cursos)
            ->with('ch_cursos', $ch_cursos)
            ->with('lcursos', $lcursos);
    }
}

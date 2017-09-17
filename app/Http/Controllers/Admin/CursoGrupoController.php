<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\Curso;
use App\CursoGrupo;
use App\Grupo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoGrupoController extends Controller
{
    public function index($grupo_id = null)
    {
        /* @todo: Sort by description */
        $acceso_auth = Acceso::acceso_auth();
        if ($grupo_id == null) {
            $grupo_id = $acceso_auth->grupo_id;
        }

        $grupo = Grupo::find($grupo_id);

        $cursos = $grupo->cursoGrupo;

        return view('admin.cursogrupo.index')
            ->with('cursos', $cursos)
            ->with('grupo', $grupo)
            ->with('acceso_auth',$acceso_auth);
    }


    public function edit($id)
    {
        /* @todo: Only courses not assigned */
        $grupo = Grupo::find($id);
        $cursos = Grupo::find($id)->CursoGrupo()->get();
        /********************************************************/
        /* Datos para el CHOSEN inferior */
        /* Crea el array para el CHOSEN select multiple  */
        //$ch_cursos = $cursos->lists('curso_id')->toArray();
        $ch_cursos = [];
        foreach ($cursos as $curso) {
            $ch_cursos[] = $curso->curso_id;
            //$ch_cursos[] = $curso->curso->wcurso . " (" . $curso->curso->ccurso . ")";  
        }

        /* Crea la lista de cursos */
        $xcursos = Curso::all();

        foreach ($xcursos as $xcurso) {
            $lcursos[] = $xcurso->wcurso . " (" . $xcurso->ccurso . ")";
        }

        return view('admin.cursogrupo.edit')
            ->with('grupo', $grupo)
            ->with('cursos',$cursos)
            ->with('ch_cursos', $ch_cursos)
            ->with('lcursos', $lcursos);
    }
}

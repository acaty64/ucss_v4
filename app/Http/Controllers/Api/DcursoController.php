<?php

namespace App\Http\Controllers\Api;

use App\CursoGrupo;
use App\DCurso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grupo_id = $request->grupo_id;
        $curso_id = $request->curso_id;
        $facultad_id = $request->facultad_id;
        $sede_id = $request->sede_id;
//        $facultad_id = Session::get('facultad_id');
//        $sede_id = Session::get('sede_id');
        $dcursos = DCurso::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->where('curso_id',$curso_id)->get();

        $all = Dcurso::where('facultad_id',$facultad_id)->where('sede_id', $sede_id)->where('curso_id', $curso_id)->get();

        $lista = [];
        foreach ($all as $dcurso) {
            array_push($lista, [
                    'id'    => $dcurso->id,
                    'prioridad'=>$dcurso->prioridad, 
                    'user_id'=>$dcurso->user->id, 
                    'cdocente'=>$dcurso->user->datauser->cdocente,
                    'wdocente'=>$dcurso->user->datauser->wdocente(),
                    'curso_id' =>$dcurso->curso_id,
                    'facultad_id'=>$facultad_id,
                    'sede_id'=>$sede_id,
                    'sw_cambio'=>$dcurso->sw_cambio,
                ]);
        };
//dd('post index',$lista);
        return [
            'success' => true,
            'data' => $lista
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $all = collect($request->registros);  
        foreach ($all as $item) {
            $dcurso = Dcurso::find($item['id']);
            $dcurso->prioridad = $item['prioridad'];
            $dcurso->save(); 
        };
        $options = $all->first();
        /* Modifica el sw_cambio de CursoGrupo*/
        $facultad_id = $options['facultad_id'];
        $sede_id = $options['sede_id'];
        $curso_id = $options['curso_id'];
        $grupo_id = $options['grupo_id'];
        $cursoGrupo = CursoGrupo::where('curso_id',$curso_id)->where('grupo_id',$grupo_id)->first();
        $cursoGrupo->sw_cambio = 1;
        $cursoGrupo->save();

        return [
           'success' => true,
            ];
    }

}

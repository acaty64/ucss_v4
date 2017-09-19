<?php

namespace App\Http\Controllers\Admin;

use App\Franja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class FranjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = Session::all();
        //$all = Franja::where('facultad_id', $session['facultad_id'])->where('sede_id', $session['sede_id'])->get();
        /*$franjas = Franja::where([
                ['facultad_id', $session['facultad_id']], 
                ['sede_id', $session['sede_id']]
            ])->sortByDesc('updated_at');
        */
        $franjas = DB::table('franjas')->where([
                ['facultad_id', $session['facultad_id']], 
                ['sede_id', $session['sede_id']]
            ])->orderBy('dia')->orderBy('turno')->orderBy('hora')->paginate(7);
        //$franjas = $all->sortByDesc('updated_at');
        return view('admin.franja.index')
            ->with('franjas', $franjas)
            ->with('wsede', $session['wsede']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = Session::all();
        return view('admin.franja.create')
                ->with('wsede', $session['wsede']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = Session::all();
        $data = $request->all();

        $chk = Franja::where('facultad_id', $session['facultad_id'])
                        ->where('sede_id', $session['sede_id'])
                        ->where('dia', $data['dia'])
                        ->where('turno', $data['turno'])
                        ->where('hora', $data['hora'])->first();

        if(!$chk){
            $franja = new Franja();
            $franja->facultad_id   = $session['facultad_id'];
            $franja->sede_id       = $session['sede_id'];
            $franja->wfranja       = $data['wfranja'];
            $franja->dia           = $data['dia'];
            $franja->turno         = $data['turno'];
            $franja->hora          = $data['hora'];
            $franja->save();
            Flash::success('Se ha registrado la franja con id: '.$franja->id.' de forma exitosa');
            return redirect()->route('administrador.franja.index');
        }

        Flash::error('Ya existe franja con id: '.$chk->id.' con hora: '.$chk->wfranja);
        return redirect()->route('administrador.franja.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $session = Session::all();
        
        $franjas = Franja::where('facultad_id',$session['facultad_id'])->where('sede_id',$session['sede_id'])->get();
        if(!$franjas){
            dd('No hay franjas');
        }
        
        $turnos = $franjas->sortBy('turno')->groupBy('turno');
        $gfranjas=array();
        foreach ($turnos as $key_turno => $turno) {
            $horas = $turno->where('turno',$key_turno)->sortBy('hora')->groupBy('hora');
            foreach ($horas as $key_hora => $hora) {
                array_push($gfranjas, ['turno'=>$key_turno,'hora'=>$key_hora]);
            }
        }
        $gfranjas = collect($gfranjas);

        $wfranjas =[];
        foreach ($franjas as $franja) {
            $campo = "D".$franja->dia.'_H'.$franja->turno.$franja->hora;
            $wfranjas[$campo] = $franja->wfranja;
        }
        return view('admin.franja.show')
            ->with('wfranjas', $wfranjas)
            ->with('gfranjas', $gfranjas)
            ->with('wsede',$session['wsede'])
            ->with('cfacultad',$session['cfacultad']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $franja = Franja::find($id);
        return view('admin.franja.edit')
            ->with('franja',$franja);
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
        $data = $request->all();
        // Verificacion 
        $chk = Franja::where([
                ['facultad_id', $data['facultad_id']],
                ['sede_id', $data['sede_id']],
                ['dia', $data['dia']],
                ['turno', $data['turno']],
                ['hora', $data['hora']],
                ['id','<>',$data['id']]
            ])->first();

        if(!$chk){
            $franja = Franja::find($data['id']);
            $franja->dia = $data['dia'];
            $franja->turno = $data['turno'];
            $franja->hora = $data['hora'];
            $franja->wfranja = $data['wfranja'];
            $franja->save();
            Flash::success('Se ha modificado la franja con id: '.$franja->id.' de forma exitosa');
            return redirect()->route('administrador.franja.index');
        }
        Flash::error('Ya existe franja '.$data['dia'].'/'.$data['turno'].'/'.$data['hora'].' con id: '.$chk->id.' con hora: '.$chk->wfranja);
        return redirect()->back();      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $franja = Franja::find($id);
        $franja->delete();          
        Flash::error('Se ha eliminado el registro: '.$franja->id.' '.$franja->dia.'/'.$franja->turno.'/'.$franja->hora.' - '.$franja->wfranja.' de forma exitosa');
        return redirect()->route('administrador.franja.index');
    }
}

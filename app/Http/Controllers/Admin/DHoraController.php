<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DHora;
use App\DataUser;
use App\Denvio;
use App\Franja;
use App\Http\Controllers\Admin\ListController as ListController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Lista;
use App\Menvio;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;

class DHoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('errors.000');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('errors.000');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('errors.000');
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
    public function edit($user_id)
    {
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        
        $franjas = Franja::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->get();
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

        foreach ($franjas as $franja) {
            $campo = "D".$franja->dia.'_H'.$franja->turno.$franja->hora;
            $wfranja[$campo] = $franja->wfranja;
        }

        $wdocente = DataUser::where('user_id',$user_id)->first()->wdocente();

        $collect_dhoras = DHora::where('user_id', $user_id)->where('sede_id', $sede_id)->where('facultad_id', $facultad_id)->get();

        $dhoras = [];
        foreach ($collect_dhoras as $key => $value) {
            $dhoras[$value->wfranja] = 'on';
        }

        $sw_cambio = $this->sw_cambio($user_id, 'disp');

        return view('admin.dhora.edit')
            ->with('sw_cambio',$sw_cambio)
            ->with('wfranja', $wfranja)
            ->with('gfranjas',$gfranjas)
            ->with('dhoras', $dhoras)
            ->with('wdocente',$wdocente)
            ->with('user_id',$user_id);
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
        // Rehacer data
        //$franjas = Franja::get();
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        // Elimina la disponibilidad horaria anterior
        $dhoras = DHora::where('user_id', $request->user_id)->where('facultad_id',$facultad_id)->where('sede_id',$sede_id);
        foreach ($dhoras as $dhora) {
            $dhora->delete();
        }
        // Genera nuevas franjas en DHora
        $franjas = Franja::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->get();
        foreach ($franjas as $franja) {
            $campo = 'D'.$franja->dia.'_H'.$franja->turno.$franja->hora;
            if ($request->$campo == "on") {
                $dhora = new DHora;
                $dhora->user_id = $request->user_id;
                $dhora->facultad_id = $facultad_id;
                $dhora->sede_id = $sede_id;
                $dhora->wfranja = $campo;
                // Graba en archivo Dhoras
                $dhora->save();
            }
        }
        
        // Modifica switch respuesta en Denvios
        $acceso = Acceso::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->where('user_id', $request->user_id)->first();
        $denvio = Menvio::find($acceso->disp_id)->denvios->first();
        if(!empty($denvio)){
            $denvio->sw_rpta1 = '1';
            $denvio->save();
        }

        // Redirecciona segun tipo de usuario
        Flash::success('Se ha registrado la modificación de disponibilidad horaria de forma exitosa');
        if (Session::get('ctype') == 'Administrador') {
            return redirect()->route('administrador.user.index');
        }else{
            return redirect()->route(strtolower(Session::get('ctype')).'.dhora.edit', $user_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('errors.000');
    }

    /* Identifica si tiene envio de disponibilidad pendiente */
        // Si el usuario es Administrador puede modificar
        // Selecciona los denvios del usuario
        // Selecciona los menvios relacionados
        // Verifica si existe un menvio pendiente 
    public function sw_cambio($user_id, $tipo)
    {
        if (Session::get('ctype') == 'Administrador' || Session::get('ctype') == 'Master') {
            $sw_cambio = '1';
        }else{
            date_default_timezone_set('America/Lima');
            $hoy = Carbon::now();
            $ayer = Carbon::now()->subDays(1);
            $denvios = User::find($user_id)->denvios;
            if (!empty($denvios)) {
                $menvios = [];
                $contador = 0;
                foreach ($denvios as $denvio) {
                    if ($denvio->menvio->tipo=$tipo 
                            and $denvio->menvio->fenvio < $hoy
                            and $denvio->menvio->flimite > $ayer)
                    {
                        $menvios[$contador++] = $denvio->menvio->toArray();
                    }
                }
                if(!empty($menvios)){
                    $sw_cambio = '1';
                }else{
                    $sw_cambio = '0';
                }
            }else{
                $sw_cambio = '0';
            }            
        }
        return $sw_cambio;
    }

    /* Lista las actualizaciones de disponibilidad de horas */
    public function lista()
    {
        $lista = Lista::listar('disp','sw_rpta1');
        return view('admin.disp.lista')
            ->with('lista', $lista)
            ->with('tipo', 'dhora')
            ->with('title', 'Disponibilidad de Horarios');
    } 

    public function List2Excel()
    {       
        $lista = Lista::listar('disp','sw_rpta1');
        $now = Carbon::now();
        $namefile = 'DH_'.$now->format('Y').'_'.$now->format('m').'_'.$now->format('d').'_'.$now->format('H').'_'.$now->format('i').'_'.$now->format('s');
        Excel::create($namefile, function($excel) use($lista){
            $excel->sheet('Disponibilidad Horaria', function($sheet) use($lista){
                $sheet->fromArray($lista);
            });
        })->download('xls');
    }
    
}

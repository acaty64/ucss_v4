<?php

namespace App\Http\Controllers;

use App\Acceso;
use App\Facultad;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultades = \App\facultad::all();
        foreach ($facultades as $facultad) {
            $opc_facu[$facultad->id] = $facultad->wfacultad;
        }

        $sedes = \App\sede::all();
        foreach ($sedes as $sede) {
            $opc_sede[$sede->id] = $sede->wsede;
        }
        return view('home')
            ->with('opc_facu',$opc_facu)
            ->with('opc_sede',$opc_sede);
    }

    public function acceso(Request $request)
    { 
        $facultad=Facultad::find($request->facultad_id);
        $sede=Sede::find($request->sede_id);
        
        Session::put('facultad_id',$facultad->id);
        Session::put('cfacultad',$facultad->cfacultad);
        Session::put('sede_id',$sede->id);
        Session::put('csede',$sede->csede);

        $usuario = Auth::user();

        if ($usuario->acceder) {
            return view('ok');
        } else {
            return back();
        }    
    }
}

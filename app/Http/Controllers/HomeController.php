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
        return view('home');
    }

    public function acceso(Request $request)
    {
        $facultad=Facultad::where('wfacultad', $request->sel_facu)->first();
        $sede=Sede::where('wsede',$request->sel_sede)->first();
        
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

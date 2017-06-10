<?php 

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DataUser;
use App\Facultad;
use App\Http\Controllers\Controller;
use App\Sede;
use App\User;
use Illuminate\Foundation\Auth\Access\can;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class AccesoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $acceso = Acceso::where('facultad_id', $facultad_id)->where('sede_id', $sede_id)->where('user_id', $user_id)->first();

        $facultades = \App\facultad::all();
        foreach ($facultades as $facultad) {
            $opc_facu[$facultad->id] = $facultad->wfacultad;
        }

        $sedes = \App\sede::all();
        foreach ($sedes as $sede) {
            $opc_sede[$sede->id] = $sede->wsede;
        }

        if(auth()->user()->can('is_master',Acceso::class)){        
            $types = \App\type::all();
        }else{
            $types = \App\type::where('name','<>','Master')->where('name','<>','Administrador')->get();
        }
        foreach ($types as $type) {
            $opc_type[$type->id] = $type->name;
        }

        return view('admin.acceso.edit')
            ->with('acceso',$acceso)
            ->with('facultades', $opc_facu)
            ->with('sedes', $opc_sede)
            ->with('types',$opc_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $acceso = Acceso::find($request->id);
        $acceso->fill($request->all());
        $acceso->save();
        Flash::warning('Se ha modificado el usuario: '.$acceso->user_id.' : '.$acceso->wdocente.' de forma exitosa');

        return redirect()->route('administrador.user.index');

    }

/**
        // Actualiza el sw_envio en archivo Denvios
        date_default_timezone_set('America/Lima');
        $hoy = Carbon::now();
        $ayer = Carbon::today()->subDays(1);
        $denvios = User::find($request->user_id)->denvios;
        if (empty($denvios)) {
            Flash::success('No se ha enviado correo electronico');
            return redirect()->back();
        }else{
            $salida = collect([]);      
            foreach ($denvios as $denvio) {
                $menvio = $denvio->menvio;
                $salida = $salida->merge(['hoy'=>$hoy,'ayer'=>$ayer,'fenvio'=>$denvio->menvio->fenvio, 'flimite'=>$denvio->menvio->flimite]);
                if ($denvio->menvio->fenvio < $hoy
                            and $denvio->menvio->flimite > $ayer) 
                {
                    $denvio->sw_rpta = '1';
                    $denvio->save();
                }
            }
        }
*/
}

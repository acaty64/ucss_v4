<?php

namespace App\Http\Controllers\Admin;

use App\Denvio;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menvio;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
 
class MenvioController extends Controller
{
    /**
     * INDICE DEL MAESTRO DE ENVIOS.
     *
     * @return view('administrador.envios.index')
            ->with('Menvios', $Menvios);
     */
    public function index()
    {
        $this->recontar_envios();
        $this->recontar_rptas();
        /*  PARA SELECT HORA DE ENVIO QUEUE
        date_default_timezone_set('America/Lima');
        $contador = 1;
        $hora_ini = substr(Carbon::now()->format('H:i:s'),0,2)+1;
        $hora_fin = 24;
        */
        $sede_id = Session::get('sede_id');
        $facultad_id = Session::get('facultad_id');
        $Menvios = Menvio::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->orderBy('id', 'DESC')->paginate(6);
        return view('admin.envios.index')
            ->with('Menvios', $Menvios);
        //    ->with('hora_ini',$hora_ini)
        //    ->with('hora_fin',$hora_fin);
    }

    /**
     * MUESTRA LA VISTA PARA LA CREACIÓN DE
     * NUEVOS REGISTROS DEL MAESTRO DE ENVIOS
     * Show the form for creating a new resource.
     *
     * @return view('admin.envios.create');
     */
    public function create()
    {
        return view('admin.envios.create');
    }

    /**
     * GRABA EL NUEVO REGISTRO DEL MAESTRO DE ENVIOS
     * Store a newly created resource in storage.
     *
     * @param  administrador.envios.create -> $request
     * @return redirect()->route('administrador.menvios.index');
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        $menvio = new menvio($request->all());
        $menvio->user_id = $user_id;
        $menvio->fenvio = date('Y-m-d');
        $menvio->facultad_id = $facultad_id;
        $menvio->sede_id = $sede_id;
        $menvio->save(); 
        Flash::success('Se ha registrado '.$menvio->txt_need.' de forma exitosa');
        return redirect()->route('administrador.menvio.index');
    }

    /**
     * MUESTRA LOS DETALLES DE ENVIOS ENVIADOS
     * Display the specified resource.
     *
     * @param  administrador.Menvios.index ->  Menvio->$id
     * @return \Illuminate\Http\Response
     *      view('administrador.envios.list')
                ->with('Denvios', $Denvios);
     */
    public function show($id)
    {
        //dd('MenviosController@show: '.$id);
        $Denvios = Denvio::where('menvio_id','=',$id)
                            ->Paginate(10);
        //dd($Denvios);
        return view('admin.envios.list')
            ->with('Denvios', $Denvios);
    }

    /**
     * MUESTRA EL REGISTRO DEL MAESTRO DE ENVIOS A MODIFICAR
     * Show the form for editing the specified resource.
     *
     * @param  administrador.Menvios.index ->  Menvio->$id
     * @return view('admin.envios.edit')
                ->with('Menvios', $menvios);
     */
    public function edit($id)
    {
        //dd('MenviosController.edit '.$id);
        $menvio = Menvio::find($id);
        //dd($menvio);
        return view('admin.envios.edit')
            ->with('menvio',$menvio);
    }

    /**
     * ACTUALIZA EL MAESTRO DE DETALLES DE ENVIOS MODIFICADO
     * Update the specified resource in storage.
     *
     * @param  admin.Menvios.edit.blade.php -> $request
     * @param  int  $id
     * @return back()
     */
    public function update(Request $request)
    {
        $menvio = Menvio::find($request->menvio_id);
        $menvio->tipo = $request->tipo;
        $menvio->flimite = $request->flimite;
        $menvio->tx_need = $request->tx_need;
        $menvio->save();
        Flash::success('Grupo de Envios modificado exitosamente.');
        return redirect()->route('administrador.menvio.index');
    }

    /**
     * ELIMINA EL REGISTRO EN EL MAESTRO DE ENVIOS Y LOS DETALLES ASOCIADOS
     * Remove the specified resource from storage.
     *
     * @param  admin.Menvios.index ->  Menvio->$id
     * @return ********* BACK()
     */
    public function destroy($id)
    {
        //        dd('En construcción: MenviosController@destroy');
        $denvios = Menvio::find($id)->denvios;
        foreach ($denvios as $denvio) {
            $xdenvio = Denvio::find($denvio->id);
            $xdenvio->delete();
        }
        $menvio =  Menvio::find($id);
        $menvio->delete();          
        Flash::error('Se ha eliminado el grupo de envios: '.$menvio->id.' de forma exitosa');
        return redirect()->route('admin.menvios.index');
    }

    /**
     * RECUENTA LOS DETALLES DE ENVIOS MARCADOS
     *
     * @param  MenviosController.index()
     */
    public function recontar_envios()
    {
        $Menvios = Menvio::all();
        if ($Menvios->isEmpty() == false) 
        {
            foreach ($Menvios as $Menvio) 
            {
                $denvios = $Menvio->denvios;
                $Menvio->envio1 = $denvios->sum('sw_envio');
                $Menvio->envio2 = $denvios->sum('sw_envio');
                $Menvio->save();
            }  
        }           
    }


    /**
     * RECUENTA LAS RESPUESTAS DE LOS DETALLES DE ENVIOS
     *
     * @param  MenviosController.index()
     */
    public function recontar_rptas()
    {
        $Menvios = Menvio::all();
        if ($Menvios->isEmpty() == false) 
        {
            foreach ($Menvios as $Menvio) 
            {
                $denvios = $Menvio->denvios;
                $Menvio->rpta1 = $denvios->sum('sw_rpta1');
                $Menvio->rpta2 = $denvios->sum('sw_rpta2');
                $Menvio->save();
            }  
        }

/**        $Menvios = Menvio::all();
        if($Menvios->isEmpty() == false)
        {
            foreach ($Menvios as $Menvio) 
            {
                $Denvios = $Menvio->denvios()->get();
                $rpta1 = 0;
                $rpta2 = 0;
                if ($Denvios->isEmpty() == false) 
                {
                    foreach ($Denvios as $Denvio) 
                    {
                        if ($Denvio->tipo == 'cursos') {
                            $rpta2 = $rpta2 + $Denvio->sw_rpta;
                        }else{
                            $rpta1 = $rpta1 + $Denvio->sw_rpta;
                        }
                    }
                }
                $xEnvio = Menvio::find($Menvio->id);
                $xEnvio->rpta1 = $rpta1;
                $xEnvio->rpta2 = $rpta2;
                $xEnvio->save();
            }    
        }
*/
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\Denvio;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menvio;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
 
class DenvioController extends Controller
{
    /**
     * MUESTRA LOS DETALLES DE ENVIOS A DEFINIR
     * Display the specified resource.
     *
     * @param  admin.Menvios.index.blade.php : Menvio->$id
     * @return view('admin.envios.send') 
                ->with('denvios', $denvios);
     */
    public function define($id)
    {
        // Recuperar los Denvios del Menvio
        $menvio = Menvio::find($id);
        $tipo = $menvio->tipo;
        $updated_at = $menvio->created_at;
        $denvios = $menvio->denvios()->get();
        if($denvios->isEmpty())
        {
            $accesos = Acceso::acceso_disponibilidad()->sortBy('wdocente');
            foreach ($accesos as $user) {
                // Grabar registro a registro
                $denvio = new Denvio;
                $denvio->user_id = $user->id;
                $denvio->menvio_id = $id;
                $denvio->email_to = $user->datauser->email1;
                $denvio->email_cc = $user->datauser->email2;
                $denvio->updated_at = $updated_at;
                $denvio->tipo = $tipo;
                $denvio->save();                
            }
        }
/**        if ($tipo = 'disp') {
            $denvios = Denvio::Stipo(['menvio_id'=>$id, 'type'=>'horas'])->orderBy('id','ASC')->paginate(10);
        }else{
            $denvios = Menvio::find($id)->denvios->Stipo('carga')->orderBy('id','ASC')->paginate(10);
        }
*/
        $denvios = Denvio::where('menvio_id',$id)->where('tipo', $tipo)->paginate(10);
        foreach ($denvios as $denvio) {
            $denvio->cdocente = User::find($denvio->user_id)->datauser->cdocente;
            $denvio->wdocente = User::find($denvio->user_id)->datauser->wdocente();
        } 
        // Enviar a la vista define los denvios
        return view('admin.envios.define')
            ->with('denvios', $denvios);
    }

    /**
     * ACTUALIZA LAS MARCAS DE LOS DETALLES DE ENVIOS (PAGINA ACTUAL) 
     * Update the specified resource in storage.
     *
     * @param  admin.envios.define.blade.php : $request
     * @return back() 
     */
    public function update(Request $request)
    {
        $denvios = $request['xenvios'];
        $contador01 = 0;
        $contador10 = 0;
        foreach ($denvios as $id => $value) {
            $denvio = Denvio::find($id);
            if ($denvio->getOriginal('sw_envio') != $value) {
                $denvio->sw_envio = $value;
                if ($denvio->sw_envio == 1) {
                    $contador01++;
                }else{
                    $contador10++;
                }
                $denvio->save();

/**
                // Actualiza la marca de detalles de envios CURSOS
                $envio_curso = Denvio::where('user_id','=',$denvio->user_id)
                    ->where('menvio_id','=',$denvio->menvio_id)->get();
                foreach ($envio_curso as $envio) {
                    $envio->sw_envio = $value;
                    $envio->save();
                }
*/
            }
        }
        Flash::success($contador01.' marcas agregadas, '.$contador10. ' marcas eliminadas.');
        return back();                
    }

    /**
     * MARCA TODOS LOS DETALLES DE ENVIOS
     *
     * @param  admin.envios.send.blade.php : Menvio->$id
     * @return back()
     */
    public function markall($id)
    {
        $menvio = Menvio::find($id);
        $id = $menvio->id;
        $type = $menvio->tipo;
        $updated_at = $menvio->created_at;
        
        $newvalue = 1;
        $contador01 = 0;
        $contador10 = 0;
        $denvios = Menvio::find($id)->denvios()->get(); 
        foreach ($denvios as $denvio) {
            $denvio->sw_envio = $newvalue;
            $denvio->updated_at = $updated_at;
            if ($denvio->getOriginal('sw_envio') != $newvalue) {
                if ($denvio->sw_envio == 1)
                {
                    $contador01++;
                }
            }
            $denvio->save();
        }
        Flash::success($contador01.' marcas agregadas, '.$contador10. ' marcas eliminadas.');
        return back();  
    }

    /**
     * DESMARCA TODOS LOS DETALLES DE ENVIOS
     *
     * @param  admin.envios.send.blade.php : Menvio->$id
     * @return back()
     */
    public function unmarkall($id)
    {
        $menvio = Menvio::find($id);
        $id = $menvio->id;
        $type = $menvio->tipo;
        $updated_at = $menvio->created_at;
           
        $newvalue = 0;
        $contador01 = 0;
        $contador10 = 0;
        $denvios = Menvio::find($id)->denvios()->get(); 
        foreach ($denvios as $denvio) {
            $denvio->sw_envio = $newvalue;
            $denvio->updated_at = $updated_at;
            if ($denvio->getOriginal('sw_envio') != $newvalue) {
                if ($denvio->sw_envio == 0)
                {
                    $contador10++;
                }
                $denvio->save();
            }
        }
        Flash::success($contador01.' marcas agregadas, '.$contador10. ' marcas eliminadas.');
        return back();  
    }


}

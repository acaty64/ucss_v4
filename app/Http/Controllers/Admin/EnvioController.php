<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DCurso;
use App\Denvio;
use App\Dhora;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menvio;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Swift_SwiftException;

class EnvioController extends Controller
{

     /**************  EN CONSTRUCCION *************************************************
     * ENVIO DE CORREOS ELECTRONICOS
     *
     * @param  admin.Menvios.index ->  Menvio->$id
     * @return ******* BACK() *****************
     *          ****** DERIVAR view SEGUN TIPO DE ENVIO
     *          ****** ACTUALIZAR MENVIOS -> sw_envio *************
     */
    public function send($id)
    {
        $dias = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
        $contador_xx = 0;
        $contador = 0;
        $correos = Menvio::find($id)->denvios->all();
        foreach ($correos as $correo) {
            if ($correo->sw_envio == 0) {
                $contador_xx++;
                $correo->delete();     
            }else{
                // Los correos detalle cursos no se deben enviar (son Menvio->tipo == 'disp')
                if($correo->tipo != 'cursos')     
                {               
                    // Define información según tipo de envío.                   
                    if ($correo->tipo='horas') {
                        $data=['flimite'=>$correo->menvio->flimite,
                                'dlimite'=>$dias[date("w")],
                                'wdocente'=>$correo->user->datauser->wDocente(),
                                'email'=>$correo->user->email,
                                'auth_name' => auth()->user()->datauser->wdocente(),
                                'cfacultad' => Session::get('wfacultad'),
                                'csede' => Session::get('wsede')
                            ];
                        $blade = 'admin.envios.email_01';
                        $contador++;
                    }elseif($correo->tipo='carga'){
    ///////////////////////////////////////
                        $data = 'FALTA DEFINIR DATA PARA ENVIAR AL BLADE';
                        
                        $blade = 'admin.envios.email_02';
                        $contador++;
                    }
                    // Enviar correo
                    try{
                        Mail::send($blade, $data, function ($message) use($correo) {
                            // MODIFICAR AL CORREGIR TABLA USERS: $correo->user->wdocente($correo->user->id)
                            //$message->from(config('mail.username'), \Auth::user()->wDocente(\Auth::user()->id))
                            $message->from(auth()->user()->email, auth()->user()->datauser->wdocente())
                                ->to($correo->email_to, User::find($correo->user_id)->datauser->wdocente())
                                ->subject($correo->menvio->tx_need)
                                ->password('ucss20505378629');
                        });
                        $this->enviado($correo);
                    } catch(Swift_SwiftException $e) {
    ///////////////////////////////////////
                        // *********** ERROR DE ENVIO DE CORREO ELECTRONICO ***********
                            dd($e);
                    }
                }
            }
        }
        // Asignación del switch envío en el Maestro de Envíos.
        $Menvio = Menvio::find($id);
        $Menvio->sw_envio = 1;
        $Menvio->save();
//dd('enviados: '.$contador. ' / eliminados: '.$contador_xx);
        Flash::success('Se han enviado '.$contador.' correos de forma exitosa');
        return redirect()->route('administrador.menvio.index');
    }

    /*
     * MARCAR SW_CAMBIO EN LOS ARCHIVOS QUE SE REQUIEREN INFORMACION
     *
     */
    public function enviado($correo)
    {
        if ($correo->menvio->tipo == 'disp') 
        {   
            // Selecciona el acceso 
            $facultad_id = Session::get('facultad_id');
            $sede_id = Session::get('sede_id');
            $user_id = $correo->user_id;
            $acceso = Acceso::where('facultad_id',$facultad_id)
                        ->where('sede_id', $sede_id)
                        ->where('user_id', $user_id)->first();
            $acceso->dhora = true;
            $acceso->dcurso = true;
            $acceso->save();
/**
            $user_id = $correo->user_id;
            // Permite acceso a la disponibilidad de horarios 
            $dhora = $correo->user->dhora;
            $dhora->sw_cambio = '1';
            $dhora->updated_at = $dhora->getOriginal('updated_at');
            $dhora->save();
            // Permite acceso a la disponibilidad de cursos 
            $dcursos = Dcurso::where('user_id','=',$user_id)->get();
            foreach ($dcursos as $dcurso) {
                $dcurso->sw_cambio = '1';
                $dcurso->updated_at = $dcurso->getOriginal('updated_at');
                $dcurso->save();
            }
*/
        }else{
            /// FALTA PROGRAMAR ACCESO A HORARIOS
        }
    }

    public function testsend()
    {
        // Enviar correo
        try{
            $data =array('wdocente' => 'Docente de Prueba');
            Mail::send('admin.envios.email_test', $data, function ($message) {
                //$message->from(config('mail.username'), \Auth::user()->wDocente(\Auth::user()->id));
                $message->from(\Auth::user()->email, \Auth::user()->datauser->wdocente());
                $message->to('correo_to@example.com')->cc('correo_cc@example.com');
            });
        } catch(Swift_SwiftException $e) {
///////////////////////////////////////
            // *********** ERROR DE ENVIO DE CORREO ELECTRONICO ***********
                dd($e);
        }
    }

}

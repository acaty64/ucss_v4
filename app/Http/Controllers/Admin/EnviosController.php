<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Menvio;
use App\Denvio;
use App\Dhora;
use App\DCurso;
use Laracasts\Flash\Flash;
use Swift_SwiftException;

class EnviosController extends Controller
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
//return view('errors.000');
    //dd('No envia con el correo de .env');
        $dias = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
        $contador_xx = 0;
        $contador = 0;
        $correos = Menvio::find($id)->denvios->all();
        foreach ($correos as $correo) {
            if ($correo->sw_envio == 0) {
                $contador_xx++;
                $correo->delete();     
            }else{
                // Los correos cursos no se envian (son Menvio->tipo == 'disp')
                if($correo != 'cursos')     
                {                
                    // Define información según tipo de envío.                   
                    if ($correo->tipo='horas') {
                        $data=array('flimite'=>$correo->menvio->flimite,
                            'dlimite'=>$dias[date("w")],
                            'wdocente'=>$correo->user->wDocente($correo->user->id),
                            'username'=>$correo->user->username );
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
                        Mail::send('admin.envios.email_test', $data, function ($message) use($correo) {
                            // MODIFICAR AL CORREGIR TABLA USERS: $correo->user->wdocente($correo->user->id)
                            $message->from(config('mail.username'), \Auth::user()->wDocente(\Auth::user()->id))
                                ->to($correo->email_to, $correo->user->wdoc1)
                                ->subject($correo->menvio->tx_need);
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
        return redirect()->route('admin.menvios.index');
    }

    /*
     * MARCAR SW_CAMBIO EN LOS ARCHIVOS QUE SE REQUIEREN INFORMACION
     *
     */
    public function enviado($correo)
    {
        if ($correo->menvio->tipo == 'disp') 
        {   
            $user_id = $correo->user_id;
            /* Permite acceso a la disponibilidad de horarios */
            $dhora = $correo->user->dhora;
            $dhora->sw_cambio = '1';
            $dhora->updated_at = $dhora->getOriginal('updated_at');
            $dhora->save();
            /* Permite acceso a la disponibilidad de cursos */
            $dcursos = Dcurso::where('user_id','=',$user_id)->get();
            foreach ($dcursos as $dcurso) {
                $dcurso->sw_cambio = '1';
                $dcurso->updated_at = $dcurso->getOriginal('updated_at');
                $dcurso->save();
            }
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
                $message->from(config('mail.username'), \Auth::user()->wDocente(\Auth::user()->id));
                $message->to('correo_to@example.com')->cc('correo_cc@example.com');
            });
        } catch(Swift_SwiftException $e) {
///////////////////////////////////////
            // *********** ERROR DE ENVIO DE CORREO ELECTRONICO ***********
                dd($e);
        }
    }

}

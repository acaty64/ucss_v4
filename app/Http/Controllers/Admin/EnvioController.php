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
use Illuminate\Mail\TransportManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
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
        $contador = 0;
        $correos = Menvio::find($id)->denvios->all();
        foreach ($correos as $correo) {
            if ($correo->sw_envio == 0) {
                $correo->delete();     
            }else{               
                // Define información según tipo de envío.                   
                if ($correo->tipo='disp') {
                    $data=['flimite'=>$correo->menvio->flimite,
                            'dlimite'=>$dias[date("w")],
                            'wdocente'=>$correo->user->datauser->wDocente(),
                            'email'=>$correo->user->email,
                            'bcc'=>auth()->user()->email,
                            'auth_name' => auth()->user()->datauser->wdocente(),
                            'tx_need'=>$correo->menvio->tx_need,
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
                    Mail::send($blade, $data, function ($message) use($data) {
                        $message->from($data['bcc'], $data['auth_name'])
                            ->bcc($data['bcc'])
                            ->to($data['email'], $data['wdocente'])
                            ->subject($data['tx_need']);
                    });
                    $this->enviado($correo);
                } catch(Swift_SwiftException $e) {
///////////////////////////////////////
                    // *********** ERROR DE ENVIO DE CORREO ELECTRONICO ***********
                        dd($e);
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
     * REDEFINICION DE CONFIGURACION 
     * https://laravel.io/index.php/forum/07-22-2014-swiftmailer-with-dynamic-mail-configuration
     */
/**    public function overrideMailerConfig($configs){
        Config::set('mail.driver',$configs['driver']);
        Config::set('mail.host',$configs['host']);
        Config::set('mail.port',$configs['port']);
        Config::set('mail.username',$configs['username']);
        Config::set('mail.password',$configs['password']);
        Config::set('mail.encryption',$configs['encryption']);
        Config::set('mail.sendmail',$configs['sendmail']);

        $app = App::getInstance();

        $app['swift.transport'] = $app->singleton(function ($app) {
            return new TransportManager($app);
        });

        $mailer = new \Swift_Mailer($app['swift.transport']->driver());
        Mail::setSwiftMailer($mailer);
    }
*/
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
            $acceso->disp_id = $correo->id;
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
            $facultad_id = Session::get('facultad_id');
            $sede_id = Session::get('sede_id');
            $user_id = $correo->user_id;
            $acceso = Acceso::where('facultad_id',$facultad_id)
                        ->where('sede_id', $sede_id)
                        ->where('user_id', $user_id)->first();
            $acceso->carga = true;
            $acceso->carga_id = $correo->id;
            $acceso->save();
        }
    }
/**
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
*/
}

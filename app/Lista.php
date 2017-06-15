<?php

namespace App;

use App\Acceso;
use App\Denvio;
use App\Menvio;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Lista extends Model
{
	/**
     * List all 'accesos' with details: send/not send/answer.
     *
     * @param  $tipo = disp/hora
     * @param  $sw_rpta = sw_rpta1/sw_rpta2
     * @return collect $lista
     */ 
    protected function listar($tipo, $sw_rpta)
    {
        // Status: No comunicado.- Sin denvio
        // Lista los usuarios con lo siguiente:
        //      Solicitado: fecha de envio
        //      Limite: fecha limite
        //      Respuesta: fecha de respuesta
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        $accesos = Acceso::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->where('user_id','>',1)->get();
        $contador = 0;
        $xlista = [];
        $registro = collect([]);
        foreach ($accesos as $acceso) {
            $user_id = $acceso->user_id;
            $registro = $registro->merge([
                'user_id' => $user_id,
                'type' => $acceso->ctype,
                'wdocente' => $acceso->wdocente, 
            ]);

            $envios = Denvio::where('user_id',$user_id)->get();
            if(count($envios) == 0){
                $registro = $registro->merge([
                            'sw_rpta' => null,
                            'updated_at' => '',
                            'fenvio' => '',
                            'flimite' => '',
                            'sw_actualizacion' => 'no comunicado',
                        ]);
            }else{
                $envios = $envios->each(function($envio) use($facultad_id, $sede_id)
                {
                    return ($envio->menvio->facultad_id == $facultad_id &&
                            $envio->menvio->sede_id == $sede_id);
                });

                // Encuentra el ultimo envio
                $fenvio = '';
                foreach ($envios as $envio) {
                    if($envio->menvio->fenvio > $fenvio){
                        $menvio_id = $envio->menvio->id;
                        $denvio_id = $envio->id;
                    }
                }

                $envio = Denvio::find($denvio_id);
                $menvio = Menvio::find($menvio_id);
                if($envio->menvio->tipo == $tipo){
                    $registro = $registro->merge([
                        'sw_rpta' => $envio->sw_rpta,
                        'updated_at' => $envio->updated_at,
                        'fenvio' => $menvio->fenvio,
                        'flimite' => $menvio->flimite,
                    ]);
                    if ($envio->$sw_rpta == true) {
                        $registro = $registro->merge([
                            'sw_actualizacion' => 'respondio',
                        ]);
                    } else {
                        $hoy = Carbon::now();
                        $ayer = Carbon::now()->subDays(1); 
                        if ($menvio->fenvio < $hoy
                            and $menvio->flimite > $ayer)
                        {
                            $registro = $registro->merge([
                                'sw_actualizacion' => 'solicitado',
                            ]);
                        }else{
                            $registro = $registro->merge([
                                'sw_actualizacion' => 'sin respuesta',
                            ]);
                        }
                    }
                }
            }
            $xlista[$contador++] = $registro;
        }
        $lista = collect($xlista);
        $lista = $lista->sortBy('wdocente');
        return $lista;     
    }
}

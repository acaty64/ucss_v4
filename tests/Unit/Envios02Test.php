<?php

namespace Tests\Unit;

use App\DataUser;
use App\Denvio;
use App\Menvio;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Envios02Test extends TestCase
{    
  function test_an_administrator_create_denvios()
    {
    //Having an administrator user
    $adminuser = factory(User::class)->create();
    $facultad_id = 1;
    $sede_id = 1;

    $datauser = factory(DataUser::class)->create([
          'user_id' => $adminuser->id,
          'cdocente' => str_pad($adminuser->id, 6, '0', STR_PAD_LEFT)
        ]);
    $this->authUser($adminuser->id, $facultad_id, $sede_id, 5);

    $response = $this->actingAs($adminuser);
    /* Crea el menvio */
    $hoy = Carbon::now();
    $flimite = $hoy->addDays(5);
    $request = [
      'user_id'     => $adminuser->id,
      'facultad_id' => $facultad_id,
      'sede_id'     => $sede_id,
      'fenvio'      => date('Y-m-d'),
      'flimite'     => $flimite->toDateString(),
      'tx_need'     => 'Prueba de envio.',
      'tipo'        => 'disp'
    ];
    $menvio = new Menvio($request);
    $menvio->save();

    $id = Menvio::all()->first()->id;

    $response = $this->get("administrador/denvios/define/{$id}");
    $response->assertStatus(200);

    $denvio_id = Denvio::all()->first()->id;
    $request = [ 
      'xenvios' => [$denvio_id=>'0', $denvio_id+1=>'1', $denvio_id+2=>'1'],
    ];

    //Then 
    $response = $this->put("administrador/denvios/update",$request);
    $response->assertStatus(302);

  }
}
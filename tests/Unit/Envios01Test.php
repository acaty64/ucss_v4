<?php

namespace Tests\Unit;

use App\DataUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Envios01Test extends TestCase
{    
  function test_an_administrator_create_menvio()
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

    /* Accede al index  */
    $response = $this->actingAs($adminuser);
    $response = $this->get("administrador/menvios/index")
      ->assertStatus(200);

    $hoy = Carbon::now();
    $flimite = $hoy->addDays(5);
    $request = [
      'facultad_id' => $facultad_id,
      'sede_id'     => $sede_id,
      'flimite'     => $flimite->toDateString(),
      'tx_need'     => 'Prueba de envio.',
      'tipo'        => 'disp'
    ];

    $response = $this->post("administrador/menvios/store",$request);
    $response->assertStatus(302);

    //Then 
    $this->assertDatabaseHas('menvios',[
      'facultad_id' => $facultad_id,
      'sede_id'     => $sede_id,
      'fenvio'      => date('Y-m-d'),
      'flimite'     => $flimite->toDateString(),
      'tx_need'     => 'Prueba de envio.',
      'tipo'        => 'disp'
    ]);   
  }
}
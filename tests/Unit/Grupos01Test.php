<?php

namespace Tests\Unit;

use App\DataUser;
use App\Grupo;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Grupos01Test extends TestCase
{    
  function test_CRUD_grupo()
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
    $response = $this->get("administrador/grupo/index")
      ->assertStatus(200);

    $request = [
      'cgrupo'      => 'New',
      'wgrupo'      => 'Nuevo Grupo'
    ];

    $response = $this->post("administrador/grupo/store",$request);
    $response->assertStatus(302);

    //Then 
    $this->assertDatabaseHas('grupos',[
      'facultad_id' => $facultad_id,
      'sede_id'     => $sede_id,
      'cgrupo'      => 'New',
      'wgrupo'      => 'Nuevo Grupo'
    ]);

    /// MODIFY
    $grupo = Grupo::where('cgrupo','New')->where('wgrupo','Nuevo Grupo')->first();
    $request = [
      'id'          => $grupo->id,
      'cgrupo'      => 'Nw2',
      'wgrupo'      => 'Nuevo Grupo2'
    ];

    $response = $this->put("administrador/grupo/update",$request);
    $response->assertStatus(302);

    //Then 
    $this->assertDatabaseHas('grupos',[
      'facultad_id' => $facultad_id,
      'sede_id'     => $sede_id,
      'cgrupo'      => 'Nw2',
      'wgrupo'      => 'Nuevo Grupo2'
    ]);

    // DESTROY

    $response = $this->get("administrador/grupo/destroy/".$grupo->id,$request);
    $response->assertStatus(302);

    //Then 
    $this->assertDatabaseMissing('grupos',[
      'facultad_id' => $facultad_id,
      'sede_id'     => $sede_id,
      'cgrupo'      => 'Nw2',
      'wgrupo'      => 'Nuevo Grupo2'
    ]);

  }
}
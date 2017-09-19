<?php

namespace Tests\Unit;

use App\Acceso;
use App\Franja;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Franjas02Test extends TestCase
{
  function test_an_administrator_can_edit_a_franja()
  {
    //Having an administrator user
    $user = User::find(5);
    $response = $this->actingAs($user);

    Session::put('facultad_id',1);
    Session::put('sede_id',1);
    Session::put('wsede','Lima');
    Session::put('type_id',5);
    Session::put('ctype','Administrador');

    $id = 1;

    $response = $this->get("administrador/franjas/edit/{$id}")
      ->assertStatus(200);

    $data = Franja::find($id);
    $data->dia = 1; 
    $data->turno = 1; 
    $data->hora = 1; 
    $data->wfranja = '13:30-15:00';

    $response = $this->put("administrador/franjas/update", $data->toArray());
    $response->assertRedirect('administrador/franjas/index');

    //Then 
    $this->assertDatabaseHas('franjas',[
      'id' => 1,
      'facultad_id' => 1,
      'sede_id' => 1,
      'dia' => 1, 
      'turno' => 1, 
      'hora' => 1, 
      'wfranja' => '13:30-15:00',
    ]);
	}

  function test_an_administrator_can_not_edit_an_existed_franja()
  {
    //Having an administrator user
    $user = User::find(5);
    $response = $this->actingAs($user);

    Session::put('facultad_id',1);
    Session::put('sede_id',1);
    Session::put('wsede','Lima');
    Session::put('type_id',5);
    Session::put('ctype','Administrador');

    $id = 1;

    $response = $this->get("administrador/franjas/edit/{$id}")
      ->assertStatus(200);

    $data = Franja::find($id);
    $data->dia = 1; 
    $data->turno = 1; 
    $data->hora = 2; 
    $data->wfranja = '13:30-15:00';

    $response = $this->put("administrador/franjas/update", $data->toArray());
    $response->assertRedirect('administrador/franjas/edit/1');
    
    //Then 
    $this->assertDatabaseMissing('franjas',[
      'id' => 1,
      'facultad_id' => 1,
      'sede_id' => 1,
      'dia' => 1, 
      'turno' => 1, 
      'hora' => 2, 
      'wfranja' => '13:30-15:00',
    ]);
  }
}
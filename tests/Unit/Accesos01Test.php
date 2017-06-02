<?php

namespace Tests\Unit;

use App\Acceso;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Accesos01Test extends TestCase
{
  function test_an_administrator_edit_the_acceso()
  {
    //Having an administrator user
    $user = User::find(5);
    $response = $this->actingAs($user);

    Session::put('facultad_id',1);
    Session::put('sede_id',1);
    Session::put('type_id',5);
    Session::put('ctype','Administrador');

    $modi_id = 4;
    $response = $this->get("administrador/acceso/edit/{$modi_id}")
        ->assertStatus(200);

    //When
    $new_values = Acceso::where('user_id',$modi_id)->first();

    $new_values->facultad_id= 2;
    $new_values->sede_id= 3;
    $new_values->type_id= 4;

    $response = $this->put("administrador/acceso/update", $new_values->toArray());
    //Then 
    $this->assertDatabaseHas('accesos',[
      'facultad_id'=> 2,
      'sede_id'=> 3,
      'type_id'=> 4,
      'wdocente' => $new_values->wdocente
    ]);
	}
}
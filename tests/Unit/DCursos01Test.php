<?php

namespace Tests\Unit;

use App\Acceso;
use App\DCurso;
use App\DataUser;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class DCursos01Test extends TestCase
{    
  function test_an_administrator_add_a_DCurso()
    {
    //Having an administrator user
    $adminuser = factory(User::class)->create();
    $facultad_id = 1;
    $sede_id = 1;
    
    /* A user for a edit */
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create([
          'user_id' => $user->id,
          'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)
        ]);
    $this->authUser($user->id, $facultad_id, $sede_id, 3);

    // Asignacion de valores en Session del administrador
    $this->authUser($adminuser->id, $facultad_id, $sede_id, 5);
    $response = $this->actingAs($adminuser);

    //When
    $response = $this->get("administrador/dcurso/edit/{$user->id}")
      ->assertStatus(200);

    $cursos = ['5','7'];
    $request = [
        'docente_id' => $user->id,
        'cursos'  => $cursos
      ];
    $response = $this->put("administrador/dcurso/update",$request);
    $response->assertStatus(302);

    //Then 
    $this->assertDatabaseHas('dcursos',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'curso_id'=> 5,
      'prioridad'=> 99,
      'sw_cambio'=>1
    ]);
	}

  function test_a_docente_edit_his_DCurso()
  {

    //Having a user docente
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 3;
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);

    $response = $this->actingAs($user);

    //When
    $response = $this->get("docente/dcurso/edit/{$user->id}");
      //->assertStatus(200);

    $cursos = ['5','7'];
    $request = [
        'docente_id' => $user->id,
        'cursos'  => $cursos
      ];
    $response = $this->put("docente/dcurso/update",$request);
    //$response->assertStatus(302);

    //Then 
    $this->assertDatabaseHas('dcursos',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'curso_id'=> 5,
      'prioridad'=> 99,
      'sw_cambio'=>1
    ]);
    $this->assertDatabaseHas('dcursos',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'curso_id'=> 7,
      'prioridad'=> 99,
      'sw_cambio'=>1
    ]);
  }

  function test_a_responsable_edit_his_DCurso()
  {
    //Having a user responsable
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);
    
    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 4;
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);

    $response = $this->actingAs($user);

    //When
    $response = $this->get("responsable/dcurso/edit/{$user->id}");
      //->assertStatus(200);

    $cursos = ['5','7'];
    $request = [
        'docente_id' => $user->id,
        'cursos'  => $cursos
      ];
    $response = $this->put("responsable/dcurso/update",$request);
    //$response->assertStatus(302);

    //Then 
    $this->assertDatabaseHas('dcursos',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'curso_id'=> 5,
      'prioridad'=> 99,
      'sw_cambio'=>1
    ]);
    $this->assertDatabaseHas('dcursos',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'curso_id'=> 7,
      'prioridad'=> 99,
      'sw_cambio'=>1
    ]);
  }

}
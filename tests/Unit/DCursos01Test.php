<?php

namespace Tests\Unit;

use App\Acceso;
use App\DCurso;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class DCursos01Test extends TestCase
{    
  function test_an_administrator_edit_a_DCurso()
    {
/**
    //Having an administrator user
    $adminuser = factory(User::class)->create();
    $facultad_id = 1;
    $sede_id = 1;
    
    /* A user for a edit */
/**    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);
    $this->authUser($user->id, $facultad_id, $sede_id, 3);

    // Asignacion de valores en Session del administrador
    $this->authUser($adminuser->id, $facultad_id, $sede_id, 5);
    $response = $this->actingAs($adminuser);

    $response = $this->get("administrador/dcurso/edit/{$user->id}")
      ->assertStatus(200);

    //When
    $dcursos = DCurso::where('user_id',$user->id)
      ->where('facultad_id',$facultad_id)
      ->where('sede_id',$sede_id)
      ->get();

    for ($i=0; $i < 5; $i++) { 
      Dcurso::create([
        'user_id'=>$user->id,
        'facultad_id' => $facultad_id,
        'sede_id' => $sede_id,
        'curso_id'=> Curso::all()->random()->id,
        ]);
    }
      $request = 
    
    $response = $this->post("administrador/dhora/update", [$request, $user->id]);

    //Then 
    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'D1_H11'=> 1,
      'D1_H12'=> 1,
      'D1_H13'=> 1,
      'D1_H31'=> 1,
    ]);
*/
	}

  function test_a_docente_edit_his_DCurso()
  {
/**
    //Having a user docente
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 3;
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);

    $response = $this->actingAs($user);

    $response = $this->get("docente/dhora/edit/{$user->id}")
      ->assertStatus(200);

    //When
    $dhora = DHora::where('user_id',$user->id)
      ->where('facultad_id',$facultad_id)
      ->where('sede_id',$sede_id)
      ->first();
    $request['dhoras_id'] = $dhora->id;
    $franjas = Franja::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->get();
    foreach ($franjas as $franja) {
      $campo = 'D'.$franja->dia."_H".$franja->turno.$franja->hora;
      $request[$campo] = 'off';
    }

    $request['D1_H11'] =  'on';
    $request['D1_H12'] =  'on';
    $request['D1_H13'] =  'on';
    $request['D1_H31'] =  'on';
    
    $response = $this->post("docente/dhora/update", $request);

    //Then 
    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'D1_H11'=> 1,
      'D1_H12'=> 1,
      'D1_H13'=> 1,
      'D1_H31'=> 1,
    ]);
*/
  }

  function test_a_responsable_edit_his_DCurso()
  {
/**    //Having a user responsable
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 4;
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);

    $response = $this->actingAs($user);

    $response = $this->get("responsable/dhora/edit/{$user->id}")
      ->assertStatus(200);

    //When
    $dhora = DHora::where('user_id',$user->id)
      ->where('facultad_id',$facultad_id)
      ->where('sede_id',$sede_id)
      ->first();
    $request['dhoras_id'] = $dhora->id;
    $franjas = Franja::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->get();
    foreach ($franjas as $franja) {
      $campo = 'D'.$franja->dia."_H".$franja->turno.$franja->hora;
      $request[$campo] = 'off';
    }

    $request['D1_H11'] =  'on';
    $request['D1_H12'] =  'on';
    $request['D1_H13'] =  'on';
    $request['D1_H31'] =  'on';
    
    $response = $this->post("responsable/dhora/update", $request);

    //Then 
    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'D1_H11'=> 1,
      'D1_H12'=> 1,
      'D1_H13'=> 1,
      'D1_H31'=> 1,
    ]);
*/
  }

}
<?php

namespace Tests\Unit;

use App\Acceso;
use App\DHora;
use App\DataUser;
use App\Franja;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Dhoras01Test extends TestCase
{    
  function test_an_administrator_edit_a_DHora()
    {
    //Having an administrator user
    $adminuser = User::find(2);
    $facultad_id = 1;
    $sede_id = 1;
    /* A user for a edit */
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);
    $this->authUser($user->id, $facultad_id, $sede_id, 3);

    // Asignacion de valores en Session del administrador
    $this->authUser($adminuser->id, $facultad_id, $sede_id, 5);
    $response = $this->actingAs($adminuser);   

    $response = $this->get("administrador/dhora/edit/{$user->id}")
      ->assertStatus(200);
      
    //When
    $request = [
      'user_id' => $user->id,
      'D1_H11' =>  'on',
      'D1_H12' =>  'on',
      'D1_H13' =>  'on',
      'D1_H31' =>  'on'
      ];

    $response = $this->put("administrador/dhora/update", $request);

    //Then 
    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' => 'D1_H11'
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H12',
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H13',
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H31',
    ]);
	}

  function test_a_docente_edit_his_dhora()
  {
    //Having a user docente
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 3;
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);

    $response = $this->actingAs($user);

    $response = $this->get("docente/dhora/edit/{$user->id}");
//      ->assertStatus(200);

    //When
    $request = [
      'user_id' => $user->id,
      'D1_H11' =>  'on',
      'D1_H12' =>  'on',
      'D1_H13' =>  'on',
      'D1_H31' =>  'on'
      ];
    
    $response = $this->put("docente/dhora/update", $request);

    //Then 
    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' => 'D1_H11'
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H12',
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H13',
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H31',
    ]);

  }

  function test_a_responsable_edit_his_dhora()
  {
    //Having a user responsable
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 4;
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);

    $response = $this->actingAs($user);

    $response = $this->get("responsable/dhora/edit/{$user->id}");
//      ->assertStatus(200);

    //When
    $request = [
      'user_id' => $user->id,
      'D1_H11' =>  'on',
      'D1_H12' =>  'on',
      'D1_H13' =>  'on',
      'D1_H31' =>  'on'
      ];

    $response = $this->put("responsable/dhora/update", $request);

    //Then 
    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' => 'D1_H11'
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H12',
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H13',
    ]);

    $this->assertDatabaseHas('dhoras',[
      'facultad_id' => $facultad_id,
      'sede_id' => $sede_id,
      'user_id' => $user->id,
      'wfranja' =>'D1_H31',
    ]);

  }

}
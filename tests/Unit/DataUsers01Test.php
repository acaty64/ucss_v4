<?php

namespace Tests\Unit;

use App\Acceso;
use App\DataUser;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class DataUsers01Test extends TestCase
{
  function test_an_administrator_edit_the_datauser()
  {
    //Having an administrator user
    $user = User::find(5);
    $response = $this->actingAs($user);

    Session::put('facultad_id',1);
    Session::put('sede_id',1);
    Session::put('type_id',5);
    Session::put('ctype','Administrador');

    $modi_id = 7;
    $response = $this->get("administrador/datauser/edit/{$modi_id}")
        ->assertStatus(200);

    //When
    $new_values = DataUser::where('user_id',$modi_id)->first();

    $new_values->wdoc1= 'John';
    $new_values->wdoc2= 'Doe';
    $new_values->wdoc3= 'Smith';
    $new_values->cdocente = '000050';
    $new_values->fono1 = '555-555-555';
    $new_values->fono2 = '333-333-333';
    $new_values->email1 = 'jd@gmail.com';
    $new_values->email2 = 'jd2@gmail.com';
    $new_values->whatsapp = true;

    $response = $this->put("administrador/datauser/update", $new_values->toArray());
    //Then 
    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> 'John',
      'wdoc2'=> 'Doe',
      'wdoc3'=> 'Smith',
      'cdocente' => '000050',
      'fono1' => '555-555-555',
      'fono2' => '333-333-333',
      'email1' => 'jd@gmail.com',
      'email2' => 'jd2@gmail.com',
      'whatsapp' => true,
    ]);
	}

  function test_a_consulta_edit_his_datauser()
  {
    //Having a user
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> $datauser->wdoc1,
      'wdoc2'=> $datauser->wdoc2,
      'wdoc3'=> $datauser->wdoc3
    ]);

    $facultad_id = 1;
    $sede_id = 1;

    $this->authUser($user->id, $facultad_id, $sede_id, 2);
    $response = $this->actingAs($user);

    //When
    $modi_id = $user->id;
    $new_values = DataUser::where('user_id',$modi_id)->first();

    $new_values->wdoc1= 'John';
    $new_values->wdoc2= 'Doe';
    $new_values->wdoc3= 'Smith';
    $new_values->fono1 = '555-555-555';
    $new_values->fono2 = '333-333-333';
    $new_values->email2 = 'jd2@gmail.com';
    $new_values->whatsapp = true;

    $response = $this->put("consulta/datauser/update", $new_values->toArray());
    //Then 
    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> 'John',
      'wdoc2'=> 'Doe',
      'wdoc3'=> 'Smith',
      'fono1' => '555-555-555',
      'fono2' => '333-333-333',
      'email2' => 'jd2@gmail.com',
      'whatsapp' => true,
    ]);
  }


  function test_a_docente_edit_his_datauser()
  {
    //Having a user
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> $datauser->wdoc1,
      'wdoc2'=> $datauser->wdoc2,
      'wdoc3'=> $datauser->wdoc3
    ]);

    $facultad_id = 1;
    $sede_id = 1;

    $this->authUser($user->id, $facultad_id, $sede_id, 3);
    $response = $this->actingAs($user);

    //When
    $modi_id = $user->id;
    $new_values = DataUser::where('user_id',$modi_id)->first();

    $new_values->wdoc1= 'John';
    $new_values->wdoc2= 'Doe';
    $new_values->wdoc3= 'Smith';
    $new_values->fono1 = '555-555-555';
    $new_values->fono2 = '333-333-333';
    $new_values->email2 = 'jd2@gmail.com';
    $new_values->whatsapp = true;

    $response = $this->put("docente/datauser/update", $new_values->toArray());
    //Then 
    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> 'John',
      'wdoc2'=> 'Doe',
      'wdoc3'=> 'Smith',
      'fono1' => '555-555-555',
      'fono2' => '333-333-333',
      'email2' => 'jd2@gmail.com',
      'whatsapp' => true,
    ]);
  }

  function test_a_responsable_edit_his_datauser()
  {
    //Having a user
    $user = factory(User::class)->create();
    $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);
    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> $datauser->wdoc1,
      'wdoc2'=> $datauser->wdoc2,
      'wdoc3'=> $datauser->wdoc3
    ]);

    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 4; //Responsable
    $this->authUser($user->id, $facultad_id, $sede_id, $type_id);
    
    $response = $this->actingAs($user);
    //When
    $modi_id = $user->id;
    $new_values = DataUser::where('user_id',$modi_id)->first();

    $new_values->wdoc1= 'John';
    $new_values->wdoc2= 'Doe';
    $new_values->wdoc3= 'Smith';
    $new_values->fono1 = '555-555-555';
    $new_values->fono2 = '333-333-333';
    $new_values->email2 = 'jd2@gmail.com';
    $new_values->whatsapp = true;

    $response = $this->put("responsable/datauser/update", $new_values->toArray());
    //Then 
    $this->assertDatabaseHas('datausers',[
      'wdoc1'=> 'John',
      'wdoc2'=> 'Doe',
      'wdoc3'=> 'Smith',
      'fono1' => '555-555-555',
      'fono2' => '333-333-333',
      'email1' => $new_values->email1,
      'email2' => 'jd2@gmail.com',
      'whatsapp' => true,
    ]);
  }
}
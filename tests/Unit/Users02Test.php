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

class Users02Test extends TestCase
{
   function test_edit_a_user()
   {
      //Having an administrator user
      $user = factory(User::class)->create();
      $datauser = factory(DataUser::class)->create(['user_id'=>$user->id, 'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)]);

      $facultad_id = 1;
      $sede_id = 1;
      $this->authUser($user->id, $facultad_id, $sede_id, 5);
      
      $response = $this->actingAs($user);

      // When
      $newValues = User::find($user->id);
      $newValues->name = 'John Doe';
      $newValues->email= 'jd@gmail.com';
      $newValues->password = 'secret';

      $response = $this->put('administrador/user/update', $newValues->toArray());
      
      //Then
      $this->assertDatabaseHas('users',[
        'name'=>'John Doe',
        'email'=> 'jd@gmail.com',
      ]);
	}

   function test_delete_a_user()
   {
      //Having an administrator user
      $user = factory(User::class)->create();
      $facultad_id = 1;
      $sede_id = 1;
      $this->authUser($user->id, $facultad_id, $sede_id, 5);
      $response = $this->actingAs($user);

      $delete_id = 7;

      $userForDelete = User::find($delete_id);

      $response = $this->get("administrador/user/{$delete_id}/destroy");

      //Then
      $this->assertDatabaseMissing('users',[
        'name'=> $userForDelete->name,
        'email'=> $userForDelete->email
      ]);

      $this->assertDatabaseMissing('datausers',[
        'user_id'=> $userForDelete->id
      ]);

      $this->assertDatabaseMissing('accesos',[
        'user_id'=> $userForDelete->id
      ]);

/* TODO no hay dhoras asociados*/

      $this->assertDatabaseMissing('dhoras',[
        'user_id'=> $userForDelete->id
      ]);

    }

}
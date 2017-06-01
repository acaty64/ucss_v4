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

class Users01Test extends TestCase
{
   function test_list_the_users()
   {
      //Having an administrator user
      $user = factory(User::class)->create();
      $facultad_id = 1;
      $sede_id = 1;

      $this->authUser($user->id, $facultad_id, $sede_id, 5);
      $response = $this->actingAs($user);

      // Then
      $response = $this->get('admin/user/index');
      //Then -> view Laravel DUSK
      //$response->assertStatus(200);
   }

	function test_create_a_guest_user()
   {
  		//Having an administrator user
  		$admin = factory(User::class)->create();

  		$facultad_id = 1;
  		$sede_id = 1;
      $type_id = 5;
  		$this->authUser($admin->id, $facultad_id, $sede_id, $type_id);

      $response = $this->actingAs($admin);

      // When
      $newUser = [
          'name'=>'John Doe',
          'email'=> 'jd@gmail.com',
        	'password'=>bcrypt('secret')
         ];

      $cdocente = DataUser::find(1)->newcodigo();
      $response = $this->post('administrador/user/store', $newUser);

      //Then
      $this->assertDatabaseHas('users',[
        'name'=>'John Doe',
        'email'=> 'jd@gmail.com',
      ]);
      
      $user_id = User::where('name','John Doe')->first()->id;
    
      $this->assertDatabaseHas('datausers',[
        'user_id' => $user_id,
     		'wdoc1'=> 'John Doe',
        'cdocente' => $cdocente,
        'email1'=> 'jd@gmail.com'
      ]);

      $this->assertDatabaseHas('accesos',[
        'user_id'=> $user_id,
        'facultad_id' => $facultad_id,
        'sede_id'=> $sede_id,
        'type_id'=> 2
      ]);
	}
}
<?php

namespace Tests\Unit;

use App\Acceso;
use App\DataUser;
use App\Grupo;
use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
  function test_grupo_acceso()
  {
    $facultad_id = 1;
    $sede_id = 1;
    $type_id = 4;

    $user = User::create([
        'name'=>'John Doe',
        'email'=> 'jd@gmail.com',
        'password'=>bcrypt('secret')
      ]);

    $acceso = Acceso::create([
        'user_id'=> $user->id,
        'facultad_id' => $facultad_id,
        'sede_id' => $sede_id,
        'type_id' => $type_id,
        'grupo_id' => 2,
      ]);

    $grupo = Acceso::where('grupo_id',2)->first()->grupo;
    
    $acceso = Grupo::find(2)->acceso;
    
    //dd($acceso);

	}
}
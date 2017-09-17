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

class ApiDCursoTest extends TestCase
{    
  function test_a_responsable_can_get_priority_DCursos()
    {
      //Having an responsable user
      $user = factory(User::class)->create();
      $datauser = factory(DataUser::class)->create([
              'user_id' => $user->id,
              'cdocente' => '999999'
          ]);
      $facultad_id = 1;
      $sede_id = 1;

      $datauser = factory(DataUser::class)->create([
            'user_id' => $user->id,
            'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)
          ]);
      
      $this->authUser($user->id, $facultad_id, $sede_id, 4);  // RESPONSABLE

      $teacher = factory(User::class)->create();
      $datauser = factory(DataUser::class)->create([
            'user_id' => $teacher->id,
            'cdocente' => str_pad($teacher->id, 6, '0', STR_PAD_LEFT)
        ]);

      // dcursos data
      $dcurso = DCurso::create([
          'facultad_id'=>$facultad_id,
          'sede_id'=>$sede_id,
          'curso_id'=>6,
          'user_id'=>$teacher->id,
          'prioridad'=>1,
          'sw_cambio'=>1,    
        ]);         

      $id = $dcurso->user_id;
      $wdocente = DCurso::find($dcurso->id)->user->datauser->wdocente();

      $request = ['grupo_id'=> 1, 'curso_id'=>6, 'facultad_id'=>1, 'sede_id'=>1];

      $this->actingAs($user)
          ->get("responsable/cursogrupo/index/1")
          ->assertStatus(200);
      $this->actingAs($user)
          ->post("api/dcurso/index", $request)
          ->assertStatus(200)
          ->assertExactJson([
              'success'   => true,
              'data'      => [
                      [
                        'cdocente' => $dcurso->user->datauser->cdocente,
                        'curso_id' => $dcurso->curso_id,
                        'facultad_id' => $facultad_id,                          
                        'id'    => $dcurso->id,
                        'prioridad'=>$dcurso->prioridad,
                        'sede_id' => $sede_id,
                        'user_id'=>$dcurso->user->id, 
                        'wdocente'=>$dcurso->user->datauser->wdocente(),
                        'sw_cambio'   => 1,                    
                      ], 
                  ],
          ]);
        $this->assertDatabaseHas('dcursos', [ 
                'facultad_id' => $facultad_id,                          
                'sede_id'     => $sede_id,
                'prioridad'   => $dcurso->prioridad,
                'id'          => $dcurso->id,
                'sw_cambio'   => true,
                'curso_id'    => $dcurso->curso_id,
                'user_id'     => $dcurso->user->id,                    
              ]); 

	} // end of function

  function test_a_responsable_can_updated_priority_DCursos()
    {
      //Having an responsable user
      $user = factory(User::class)->create();
      $datauser = factory(DataUser::class)->create([
              'user_id' => $user->id,
              'cdocente' => '999999'
          ]);
      $facultad_id = 1;
      $sede_id = 1;

      $datauser = factory(DataUser::class)->create([
            'user_id' => $user->id,
            'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT)
          ]);
      
      $this->authUser($user->id, $facultad_id, $sede_id, 4);  // RESPONSABLE

      // Docentes
      $teacher_1 = factory(User::class)->create();
      $datauser_1 = factory(DataUser::class)->create([
            'user_id' => $teacher_1->id,
            'cdocente' => str_pad($teacher_1->id, 6, '0', STR_PAD_LEFT)
        ]);
      $teacher_2 = factory(User::class)->create();
      $datauser_2 = factory(DataUser::class)->create([
            'user_id' => $teacher_2->id,
            'cdocente' => str_pad($teacher_2->id, 6, '0', STR_PAD_LEFT)
        ]);
      $teacher_3 = factory(User::class)->create();
      $datauser_3 = factory(DataUser::class)->create([
            'user_id' => $teacher_3->id,
            'cdocente' => str_pad($teacher_3->id, 6, '0', STR_PAD_LEFT)
        ]);

      // dcursos data
      $dcurso_1 = DCurso::create([
          'facultad_id'=>$facultad_id,
          'sede_id'=>$sede_id,
          'curso_id'=>6,
          'user_id'=>$teacher_1->id,
          'prioridad'=>1,
          'sw_cambio'=>1    
        ]);         
      $dcurso_2 = DCurso::create([
          'facultad_id'=>$facultad_id,
          'sede_id'=>$sede_id,
          'curso_id'=>6,
          'user_id'=>$teacher_2->id,
          'prioridad'=>2,    
          'sw_cambio'=>1    
        ]); 
      $dcurso_3 = DCurso::create([
          'facultad_id'=>$facultad_id,
          'sede_id'=>$sede_id,
          'curso_id'=>6,
          'user_id'=>$teacher_3->id,
          'prioridad'=>3,    
          'sw_cambio'=>1    
        ]); 

      $request = ['grupo_id'=> 1, 'curso_id'=>6, 'facultad_id'=>1, 'sede_id'=>1];

      $this->actingAs($user)
          ->post("api/dcurso/index", $request)
          ->assertStatus(200);
      $this->assertDatabaseHas('dcursos', [ 
                    'facultad_id' => $facultad_id,                          
                    'sede_id'     => $sede_id,
                    'prioridad'   => $dcurso_1->prioridad,
                    'id'          => $dcurso_1->id,
                    'sw_cambio'   => true,
                    'curso_id'    => $dcurso_1->curso_id,
                    'user_id'     => $dcurso_1->user->id                    
                  ]);
      $this->assertDatabaseHas('dcursos', [ 
                    'facultad_id' => $facultad_id,                          
                    'sede_id'     => $sede_id,
                    'prioridad'   => $dcurso_2->prioridad,
                    'id'          => $dcurso_2->id,
                    'sw_cambio'   => true,
                    'curso_id'    => $dcurso_2->curso_id,
                    'user_id'     => $dcurso_2->user->id                    
                  ]);
      $this->assertDatabaseHas('dcursos', [ 
                    'facultad_id' => $facultad_id,                          
                    'sede_id'     => $sede_id,
                    'prioridad'   => $dcurso_3->prioridad,
                    'id'          => $dcurso_3->id,
                    'sw_cambio'   => true,
                    'curso_id'    => $dcurso_3->curso_id,
                    'user_id'     => $dcurso_3->user->id                    
                  ]);

      $request = ['registros'=>[
              [ 'id'    => $dcurso_1->id,
                'prioridad'=>3, 
                'user_id'=>$dcurso_1->user->id, 
                'cdocente'=>$dcurso_1->user->datauser->cdocente,
                'wdocente'=>$dcurso_1->user->datauser->wdocente(),
                'curso_id' =>$dcurso_1->curso_id,
                'facultad_id'=>$facultad_id,
                'sede_id'=>$sede_id,
                'grupo_id'=>1,
              ],
              [ 'id'    => $dcurso_2->id,
                'prioridad'=>1, 
                'user_id'=>$dcurso_2->user->id, 
                'cdocente'=>$dcurso_2->user->datauser->cdocente,
                'wdocente'=>$dcurso_2->user->datauser->wdocente(),
                'curso_id' =>$dcurso_2->curso_id,
                'facultad_id'=>$facultad_id,
                'sede_id'=>$sede_id,
                'grupo_id'=>1,
              ],
              [ 'id'    => $dcurso_3->id,
                'prioridad'=>2, 
                'user_id'=>$dcurso_3->user->id, 
                'cdocente'=>$dcurso_3->user->datauser->cdocente,
                'wdocente'=>$dcurso_3->user->datauser->wdocente(),
                'curso_id' =>$dcurso_3->curso_id,
                'facultad_id'=>$facultad_id,
                'sede_id'=>$sede_id,
                'grupo_id'=>1,
              ]]
      ];

      $this->post("api/dcurso/update", $request)
          ->assertStatus(200)
          ->assertExactJson(['success'=>true]);

      // Then
      $this->assertDatabaseHas('dcursos', [ 
                    'facultad_id' => $facultad_id,                          
                    'sede_id'     => $sede_id,
                    'prioridad'   => 3,
                    'id'          => $dcurso_1->id,
                    'sw_cambio'   => true,
                    'curso_id'    => $dcurso_1->curso_id,
                    'user_id'     => $dcurso_1->user->id                    
                  ]);
      $this->assertDatabaseHas('dcursos', [ 
                    'facultad_id' => $facultad_id,                          
                    'sede_id'     => $sede_id,
                    'prioridad'   => 1,
                    'id'          => $dcurso_2->id,
                    'sw_cambio'   => true,
                    'curso_id'    => $dcurso_2->curso_id,
                    'user_id'     => $dcurso_2->user->id                    
                  ]);
      $this->assertDatabaseHas('dcursos', [ 
                    'facultad_id' => $facultad_id,                          
                    'sede_id'     => $sede_id,
                    'prioridad'   => 2,
                    'id'          => $dcurso_3->id,
                    'sw_cambio'   => true,
                    'curso_id'    => $dcurso_3->curso_id,
                    'user_id'     => $dcurso_3->user->id                    
                  ]);
      $this->assertDatabaseHas('cursogrupo', [ 
                    'sw_cambio'   => true,
                    'grupo_id'    => 1,
                    'curso_id'    => 6,
                  ]);


  } // end of function



} // End of class
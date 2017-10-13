<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DCursos01Test extends DuskTestCase
{
    use DatabaseMigrations;
/////// TODO: Review all
    function test_edit_a_dcurso()
    { 
        $this->artisan('db:seed');
        $this->browse(function(Browser $browser)
        {
            $user = User::find(4);
            $browser->loginAs(User::find(2))
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->pause(2500)
                    ->waitForText('Inicio')
                    ->assertSee('Usuarios')
                    ->visit('/administrador/user/index')
                    ->assertPathIs('/administrador/user/index')
                    ->visit("/administrador/dcurso/edit/{$user->id}")
                    ->click('.search-field')
                    ->select('cursos[]','3')
                    ->pause(500)
                    ->click('.search-field')
                    ->select('cursos[]', 33)
                    //->select('.select-curso','ADMINISTRACION II')
                    ->click('.search-field')
                    ->press('Grabar o Confirmar cursos')
                    ->assertSee('Se ha registrado la modificación de disponibilidad de cursos de forma exitosa')
                    ->visit("/administrador/dcurso/edit/{$user->id}")
                    ->assertSee('ADMINISTRACION I')
                    ->assertSee('ADMINISTRACION II');
        });
    }
}

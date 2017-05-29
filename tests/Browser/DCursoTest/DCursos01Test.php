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

    function test_edit_a_dcurso()
    {
        $this->artisan('db:seed');
        $this->browse(function(Browser $browser)
        {
            $user = User::find(5);
            $browser->loginAs(User::find(2))
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->assertSee('Usuarios')
                    ->visit('/administrador/user/index')
                    ->assertPathIs('/administrador/user/index')
                    ->visit("/administrador/dcurso/edit/{$user->id}")
                    ->select('.select-curso', 'ADMINISTRACION I')
                    ->select('.select-curso', 'ADMINISTRACION II')
                    ->press('Grabar o Confirmar cursos')
                    ->assertSee('Se ha registrado la modificación de disponibilidad de cursos de forma exitosa')
                    ->visit("/administrador/dcurso/edit/{$user->id}")
                    ->assertSee('ADMINISTRACION I');
        });
    }
}

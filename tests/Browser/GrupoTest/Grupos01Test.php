<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\Grupo;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Grupos01Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_CRU_grupo()
    {
        $this->artisan('db:seed');
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->assertSee('Usuarios')
                    ->visit('/administrador/grupos/index')
                    ->assertPathIs('/administrador/grupos/index')
                    ->visit('/administrador/grupos/create')
                    ->assertPathIs('/administrador/grupos/create')
                    ->type('cgrupo', 'NEW')
                    ->type('wgrupo', 'NUEVO GRUPO')
                    ->press('Registrar')
                    ->assertSee('Crear Nuevo Grupo')
                    ->assertSee('Se ha registrado NUEVO GRUPO de forma exitosa');
        });

        $grupo = Grupo::where('cgrupo','NEW')->first();
        $this->browse(function (Browser $browser) use($grupo) {
            $browser->visit('/administrador/grupos/edit/'.$grupo->id)
                    ->assertPathIs('/administrador/grupos/edit'.$grupo->id)
                    ->type('cgrupo', 'NW2')
                    ->type('wgrupo', 'NUEVO GRUPO MODIFICADO')
                    ->press('Registrar')
                    ->assertSee('Se ha modificado el registro: '.$grupo->id.' : '.$grupo->wgrupo.' de forma exitosa');
        });
    }
}

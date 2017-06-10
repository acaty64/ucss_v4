<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Users03Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_show_a_user_data()
    {
        $this->artisan('db:seed');
        $this->browse(function(Browser $browser)
        {
            $browser->loginAs(User::find(5))
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->assertSee('Lista de Usuarios')
                    ->visit('/consulta/user/index')
                    ->assertPathIs('/consulta/user/index')
                    ->visit("/consulta/datauser/show/3")
                    ->assertSee('DATOS DE USUARIO REGISTRADO')
                    ;
        });
    }
}

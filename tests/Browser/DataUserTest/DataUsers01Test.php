<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DataUsers01Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_an_administrador_edit_a_datauser()
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
                    ->pause(2500)
                    ->waitForText('Inicio')
                    ->assertSee('Usuarios')
                    ->visit('/administrador/user/index')
                    ->assertPathIs('/administrador/user/index')
                    ->visit("/administrador/datauser/edit/{$user->id}")
                    ->type('cdocente','000002')
                    ->type('wdoc1','Nuevo nombre')
                    ->type('wdoc2','Primer Apellido')
                    ->type('wdoc3','Segundo Apellido')
                    ->type('email1','newmail@gmail.com')
                    ->type('email2','otromail@gmail.com')
                    ->check('whatsapp')
                    ->press('Grabar modificaciones')
                    ->assertSee('Se ha modificado el usuario: '.$user->id.' : Primer Apellido Segundo Apellido, Nuevo nombre de forma exitosa')
                    ;

        });
    }
}

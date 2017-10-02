<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DataUsers02Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_a_consulta_edit_his_datauser()
    {
        $this->browse(function(Browser $browser)
        {
            $this->artisan('db:seed');
            $user = User::find(5);
            $browser->loginAs($user)
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->pause(2500)
                    ->waitForText('Inicio')
                    ->assertSee('Usuarios')
                    ->visit("/consulta/datauser/edit/5")
                    ->type('wdoc1','Nuevo nombre')
                    ->type('wdoc2','Primer Apellido')
                    ->type('wdoc3','Segundo Apellido')
                    ->type('email2','otromail@gmail.com')
                    ->check('whatsapp')
                    ->press('Grabar modificaciones')
                    ->assertSee('Se ha modificado el usuario: '.$user->id.' : Primer Apellido Segundo Apellido, Nuevo nombre de forma exitosa')
                    ;
        });
    }
}

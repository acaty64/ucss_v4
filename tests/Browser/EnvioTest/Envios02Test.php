<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Envios02Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_define_a_menvio()
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
                    ->visit('/administrador/menvios/index')
                    ->assertPathIs('/administrador/menvios/index')
                    ->visit('/administrador/menvios/create')
                    ->select('tipo','disp')
                    ->value('#flimite','2017-06-15')
                    ->type('tx_need','Prueba de envio.')
                    ->press('Grabar')
                    ->assertSee('Se ha registrado de forma exitosa')
                    ->click('#Add1')
                    ->assertPathIs('/administrador/denvios/define/1')
                    ->click('#check2')
                    ->click('#check3')
                    ->click('#check4')
                    ->press('#Grabar')
                    ->assertPathIs('/administrador/denvios/define/1')
                    ->assertSee('3 marcas agregadas')
                    ;
        });
    }
}

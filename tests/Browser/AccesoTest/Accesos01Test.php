<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Accesos01Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_edit_an_acceso()
    {
        $this->artisan('db:seed');
        $this->browse(function(Browser $browser)
        {
            $user = User::find(3);
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
                    ->visit("/administrador/acceso/edit/{$user->id}")
                    ->select('type_id',2)
                    ->press('Grabar modificaciones')
                    ->assertSee('Se ha modificado el usuario: ' . $user->id . ' : ' . $user->datauser->wdoc2 . " " . $user->datauser->wdoc3 . ", " . $user->datauser->wdoc1 . ' de forma exitosa')
                    ;

        });
    }
}

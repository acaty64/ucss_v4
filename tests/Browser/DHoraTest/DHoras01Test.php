<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DHoras01Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_edit_a_dhora()
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
                    ->visit("/administrador/dhora/edit/{$user->id}")
                    ->check('D1_H11')
                    ->check('D1_H12')
                    ->check('D1_H13')
                    ->check('D1_H31')
                    ->press('Grabar modificaciones')
                    ->assertSee('Se ha registrado la modificación de disponibilidad horaria de forma exitosa');
        });
    }
}

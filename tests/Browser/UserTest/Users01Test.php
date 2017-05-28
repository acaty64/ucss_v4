<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Users01Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_create_a_user()
    {
        $this->artisan('db:seed');
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->assertSee('Usuarios')
                    ->visit('/administrador/user/index')
                    ->assertPathIs('/administrador/user/index')
                    ->visit('/administrador/user/create')
                    ->assertPathIs('/administrador/user/create')
                    ->type('name', 'John Doe')
                    ->type('email', 'jd@gmail.com')
                    ->type('password', 'secret')
                    ->press('Registrar')
                    ->assertSee('Lista de Usuarios')
                    ->assertSee('Se ha registrado John Doe de forma exitosa');
        });
    }
}

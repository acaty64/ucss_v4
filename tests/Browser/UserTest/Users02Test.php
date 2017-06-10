<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Users02Test extends DuskTestCase
{
    use DatabaseMigrations;

    function test_edit_a_user()
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
                    ->visit("/administrador/user/edit/{$user->id}")
                    ->assertPathIs("/administrador/user/edit/{$user->id}")
                    ->type('name','Nuevo nombre')
                    ->type('email','newmail@gmail.com')
                    ->press('Grabar modificaciones')
                    ->assertSee('Se ha modificado el registro: '.$user->id.' : Nuevo nombre de forma exitosa')
                    ;
        });
    }
}

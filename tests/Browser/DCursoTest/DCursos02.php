<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DCursos02Test extends DuskTestCase
{
    use DatabaseMigrations;
/////// TODO: Review all
    function test_view_a_sillabus()
    {
        $this->artisan('db:seed');
        $this->browse(function(Browser $browser)
        {
            $user = User::find(4);
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
                    ->visit("/administrador/dcurso/edit/{$user->id}")
                    //->select('curso_id', '17')
                    ->click('.select-silabo')
                    ->select('.select-silabo', '17')
                    ->press('Ver silabo')
                    ->assertSee('SILABO DEL CURSO: ADMINISTRACION I')
                    ->visit("/admin/pdf/silabo");
        });
    }
}

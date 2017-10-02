<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\Denvio;
use App\Menvio;
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
            $user_id = 2; // Administrador
            $user = User::find($user_id);

            $menvio = Menvio::create([
                'user_id' => 1,
                'facultad_id' => 1,
                'sede_id' => 1,
                'fenvio' => date('Y-m-d'),
                'flimite' => date('Y-m-d'),
                'tx_need' => 'asdf',
                'tipo' => 'disp',
                'sw_envio' => 1,
            ]);
            $denvio = Denvio::create([
                'user_id' => $user->id,
                'sw_envio' => 1,
                'tipo' => 'disp',
                'menvio_id' => $menvio->id,
                'email_to' => '@gmail.com',
                ]);
            
            $acceso = Acceso::where('facultad_id', 1)->where('sede_id', 1)->where('user_id', $user->id)->first();
            $acceso->disp_id = $denvio->id;
            $acceso->save();

            $browser->loginAs(User::find($user_id))
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->pause(2500)
                    ->waitForText('Inicio')
                    ->assertSee('Usuarios')
                    ->visit('/administrador/user/index')
                    ->assertPathIs('/administrador/user/index')
                    ->visit("/administrador/dhora/edit/{$user->id}")
                    ->check('D1_H11')
                    ->check('D1_H12')
                    ->check('D1_H13')
                    ->check('D1_H31')
                    ->press('Grabar modificaciones')
                    ->assertSee('Se ha registrado ')
                    ->assertSee(' de disponibilidad horaria de forma exitosa');
        });
    }
}

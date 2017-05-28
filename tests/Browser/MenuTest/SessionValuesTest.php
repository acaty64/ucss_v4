<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SessionValuesTest extends DuskTestCase
{
    use DatabaseMigrations;

    function test_auth_master()
    {
        $this->artisan('db:seed');
        // Having
        $user = User::create([
                'name' => 'Jane Doe',
                'email' => 'jdoe@gmail.com',
                'password'  => bcrypt('secret')
            ]);
        $acceso = Acceso::create([
                'user_id' => $user->id,
                'facultad_id'   => 1,
                'sede_id'   => 1,
                'type_id'   => 1
            ]);
        // Acting
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertPathIs('/login')
                ->type('email', 'jdoe@gmail.com')
                ->type('password', 'secret')
                ->press('Login')
                ->assertSee('Facultad y Sede');
            // Then
            $browser->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->assertSee('Menus');
        });
    }
}

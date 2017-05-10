<?php

namespace Tests\Browser\unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SessionValuesTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    function test_auth_preliminar_value()
    {
        // Having
        $user = User::create([
                'name' => 'Jane Doe',
                'email' => 'jdoe@gmail.com',
                'password'  => bcrypt('secret')
            ]);
        // Acting
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertPageIs('/login')
                ->type('email', 'jdoe@gmail.com')
                ->type('password', 'secret')
                ->press('Login')
                ->assertSee('Facultad y Sede');
            // Then
            $this->assertEquals(null, Session::get('facultad_id'));
        });
    }
}

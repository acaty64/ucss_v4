<?php

namespace Tests\Browser\unit;

use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MenusActionsTest extends DuskTestCase
{
    use DatabaseMigrations;

    function test_a_master_create_a_menu()
    {
        $this->artisan('db:seed');
        // Acting
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))    // Master
                    ->visit('/home')
                    ->select('facultad_id','1')
                    ->select('sede_id','1')
                    ->press('Acceder')
                    ->pause(2500)
                    ->waitForText('Inicio')
                    ->assertPathIs('/home/acceso')
                    ->assertSee('Menus')
                    ->visit('/master/menu/index')
                    ->assertPathIs('/master/menu/index')
                    ->assertSee('Menu Index')
                    ->visit('/master/menu/create')
                    ->assertPathIs('/master/menu/create')
                    ->type('name', 'Nuevo menu')
                    ->type('href', '/new/route')
                    ->type('level',0)
                    ->type('order',0)
                    ->type('help', 'Texto ejemplo de ayuda')
                    ->check('type1')
                    ->check('type3')  
                    ->press('Registrar')
                    ->pause(2500)
                    ->assertPathIs('/master/menu/index');
    });

    function test_edit_a_menu()
    {
/**
        //Having
        $user = $this->defaultUser();
        $facultad = Facultad::find(1);
        $sede = Sede::find(1);
        $type = Type::find(1);

        $acceso = factory(Acceso::class)->create([
            'user_id'       => $user->id,
            'facultad_id'   => $facultad->id,
            'sede_id'       => $sede->id,
            'type_id'       => $type->id,
        ]);

        $menu = new Menu;
        $menu->name = 'Nuevo menu';
        $menu->href = '/accion/funcion';
        $menu->save();
        $menu_id = Menu::all()->last()->id;

        $menu_type = new MenuType;
        $menu_type->menu_id = $menu_id;
        $menu_type->type_id = 1;
        $menu_type->level = 0;
        $menu_type->order = 0;
        $menu_type->save();

        $menu_type = new MenuType;
        $menu_type->menu_id = $menu_id;
        $menu_type->type_id = 3;
        $menu_type->level = 0;
        $menu_type->order = 0;
        $menu_type->save();

        //Acting
        $this->actingAs($user);
        Session::set('facultad_id',$facultad->id);
        Session::set('cfacultad',$facultad->cfacultad);
        Session::set('sede_id',$sede->id);
        Session::set('csede',$sede->csede);
        Session::set('type_id',$type->id);
        Session::set('ctype',$type->name);

        $this->visit('/master/menu/index')
            ->seePageIs('/master/menu/index')
            ->click('4')
            ->click('Mody'.$menu_id)
            ->see('Edición de Menú');
        //Then
*/        
    }

    function test_delete_a_menu()
    {
/*
        //Having

        //Acting

        //Then
        
*/
    }

    }
}
<?php

namespace Tests\Browser\unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MenusActionsTest extends DuskTestCase
{
    use DatabaseMigrations;

    function test_auth_preliminar_value()
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
            $browser->select('sel_facu','Ciencias Económicas y Comerciales')
                    ->select('sel_sede','Lima')
                    ->click('Acceder')
                    ->click('Menus')
                    ->assertPathIs('/master/menu/index')
                    ->assertSee('Menu Index')
                    ->assertSee('Crear nuevo menú')
                    ->click('Crear Nuevo Menú')
                    ->assertPathIs('/master/menu/create')
                    ->type('name', 'Nuevo menú')
                    ->type('href', '/new/route')
                    ->type(0,'level')
                    ->type(0,'order')
                    ->check('type1')
                    ->check('type3')  
                    ->press('Registrar')
                    ->assertPathIs('/master/menu/index')
                    ->assertSee('Nuevo menú');
//////////////////////////
/**
          
        //Then
        $this->seeInDatabase('menus',[
                'name' => 'Nuevo menú',
                'href' => '/new/route'
                ]);
        $newMenu = Menu::where('name','Nuevo menú')->first();
        $this->seeInDatabase('menu_type',[
                'type_id' => 1,
                'menu_id' => $newMenu->id,
                'level' => 0,
                'order' => 0
                ]);
        $this->seeInDatabase('menu_type',[
                'type_id' => 3,
                'menu_id' => $newMenu->id,
                'level' => 0,
                'order' => 0
                ]);
        $this->see('Nuevo Menú');
    }

    public function test_edit_a_menu()
    {
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
        
    }

    public function test_delete_a_menu()
    {
        //Having

        //Acting

        //Then
        
    }
*/

        });
    }
}
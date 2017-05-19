<?php

namespace Tests\Unit;

use App\Acceso;
use App\Facultad;
use App\Menu;
use App\MenuType;
use App\Sede;
use App\Type;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class MenusActionsTest extends TestCase
{
	use DatabaseTransactions;
	public function test_a_master_create_a_menu()
	{
		// Having
		$user = factory(User::class)->create();
		$facultad = Facultad::find(2);
		$sede = Sede::find(2);
		$type = Type::find(1);

		$acceso = Acceso::create([
            'user_id'   	=> $user->id,
            'facultad_id'	=> $facultad->id,
            'sede_id'		=> $sede->id,
            'type_id'		=> $type->id,
            'cdocente' 		=> '000010'
        ]);
		
		// When
		$this->actingAs($user);
		$response = $this->get('/home');
		$response->assertStatus(200);
		$response->assertSee('Seleccione la facultad');
		$request = [
				'facultad_id' => $facultad->id,
				'sede_id' => $sede->id
			];
		$response = $this->post('/home/acceso',$request);
		$response->assertStatus(200);
		$response = $this->get('/master/menu/index');
		$response->assertStatus(200);
		$response->assertSee('Menu Index');
		$response = $this->get('/master/menu/create');
		$response->assertStatus(200);

		$request = [
				'name' => 'Nuevo menú',
				'href' => '/new/route',
				'level' => 0,
				'order' => 0,
				'type1' => 1,
				'type3' => 1
			];
		$response = $this->post('master/menu/store',$request);

		//Then
		$this->assertDatabaseHas('menus',[
				'name' => 'Nuevo menú',
				'href' => '/new/route'
				]);
		$newMenu = Menu::where('name','Nuevo menú')->first();
		$this->assertDatabaseHas('menu_type',[
				'type_id' => 1,
				'menu_id' => $newMenu->id,
				'level'	=> 0,
				'order' => 0
				]);
		$this->assertDatabaseHas('menu_type',[
				'type_id' => 3,
				'menu_id' => $newMenu->id,
				'level'	=> 0,
				'order' => 0
				]);

	}

	public function test_edit_a_menu()
	{
		//Having
		$user = factory(User::class)->create();
		$facultad = Facultad::find(1);
		$sede = Sede::find(1);
		$type = Type::find(1);

		$acceso = Acceso::create([
            'user_id'   	=> $user->id,
            'facultad_id'	=> $facultad->id,
            'sede_id'		=> $sede->id,
            'type_id'		=> $type->id,
            'cdocente' 		=> '000011'
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
        Session::put('facultad_id',$facultad->id);
        Session::put('cfacultad',$facultad->cfacultad);
        Session::put('sede_id',$sede->id);
        Session::put('csede',$sede->csede);
        Session::put('type_id',$type->id);
        Session::put('ctype',$type->name);

		$this->get('/master/menu/index')
			->assertStatus(200);
		$this->post("/master/menu/{{$menu_id}}/edit")
			->assertStatus(200);
		//Then
// TODO		
	}

	public function test_delete_a_menu()
	{
		//Having

		//Acting

		//Then
		
	}	

}

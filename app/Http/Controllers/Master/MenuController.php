<?php

namespace App\Http\Controllers\Master;

use App\Acceso;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuType;
use App\Type;
use Faker\Provider\slug;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(6);
        return view('menu/index')
            ->with('menus',$menus);            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('menu/create')
            ->with('types', $types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->href = $request->href;
        $menu->save();

        $menu_id = Menu::all()->last()->id;
        $level = $request->level;
        $order = $request->order;

        foreach ($request->all() as $xtype => $value) {
            if(substr(trim($xtype),0,4) =='type'){
                $menu_type = new MenuType;
                $menu_type->type_id = substr(trim($xtype),4,3);
                $menu_type->menu_id = $menu_id;
                $menu_type->level = $level;
                $menu_type->order = $order;
                $menu_type->save();
            }
        }

        return redirect()->route('master.menu.index');
        
    }

    /**
     * Display the tree's data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$menu = Menu::find($id);
        $var = array();
        $menuTypes = MenuType::all()->where('menu_id', $id);
        foreach ($menuTypes as $menuType) {
            $id = $menuType->id;
            $var[$id]['id'] = $menuType->id;
            $menu_name = Menu::find($menuType->menu_id)->name;
            $menu_href = Menu::find($menuType->menu_id)->href;
            $type_name = Type::find($menuType->type_id)->name;
            $var[$id]['menu_id'] = $menuType->menu_id;
            $var[$id]['type_id'] = $menuType->type_id;
            $var[$id]['menu_name'] = $menu_name;
            $var[$id]['menu_href'] = $menu_href;
            $var[$id]['type_name'] = $type_name;
            $var[$id]['level'] = $menuType->level;
            $var[$id]['order'] = $menuType->order;
        }
        $menus = collect($var);

        return view('menu/edit')
            ->with('menus', $menus);
            //->with('types',$types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('MenuController@update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('MenuController@destroy');
    }

}


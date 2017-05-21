<?php

namespace App\Http\Controllers\Master;

use App\Menu;
use App\Type;
use App\MenuType;
use App\Acceso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function generar()
    {
        $file = fopen("menus/tmp.txt", "w");
        ///fwrite($file, $option . PHP_EOL);
        // ********** ENCABEZADO ********/
        fwrite($file, '<nav class="navbar navbar-default navbar-static-top">'. PHP_EOL);
        fwrite($file, '<div class="container">'. PHP_EOL);
        fwrite($file, '<div class="navbar-header">'. PHP_EOL);
        fwrite($file, '<!-- Collapsed Hamburger -->'. PHP_EOL);
        fwrite($file, '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">'. PHP_EOL);
        fwrite($file, '<span class="sr-only">Toggle Navigation</span>'. PHP_EOL);
        fwrite($file, '<span class="icon-bar"></span>'. PHP_EOL);
        fwrite($file, '<span class="icon-bar"></span>'. PHP_EOL);
        fwrite($file, '<span class="icon-bar"></span>'. PHP_EOL);
        fwrite($file, '</button>'. PHP_EOL);

        fwrite($file, '<!-- Branding Image -->'. PHP_EOL);
        fwrite($file, '<a class="navbar-brand" href="{{ url('.'"/"'.') }}">'. PHP_EOL);
        fwrite($file, '{{ config("app.name", "Laravel") }}'. PHP_EOL);
        fwrite($file, '</a>'. PHP_EOL);
        fwrite($file, '</div>'. PHP_EOL);

        fwrite($file, '<div class="collapse navbar-collapse" id="app-navbar-collapse">'. PHP_EOL);

        // ********** FIN DE ENCABEZADO ********/
        // ********** INICIO DE OPCIONES ********/
        fwrite($file, '<!-- Left Side Of Navbar -->'. PHP_EOL);
        fwrite($file, '<ul class="nav navbar-nav" name="leftside">'. PHP_EOL);


        $types = Type::all();
        foreach ($types as $type) 
        {
            $menus = $type->menus;
            fwrite($file, "@if(Session::get('ctype')=='".$type->name."')". PHP_EOL);

            $options=[];
            $original_menus = collect([]);
            foreach ($menus as $menu) {
                $original_value = $menu->original;
                $original_menus->push($original_value);
            }
            $level0 = $menus->where('pivot_level',0)->sortBy('pivot_order')->all();
            foreach($level0 as $level){
                if($level['href']){
                    $submenu = false;
                    if($level['sw_auth']){
                        $option = '<li><a href="{{ route('."'".strtolower($type->name).'.'.$level['href'];
                        if($level['parameter']){
                            $option=$option.",".$level['parameter'];
                        }
                    }else{
                        $option = '<li><a href="{{ route('."'".$level['href'];
                    }
                    $option = $option."')".'}}">'.$level['name']."</a></li>";                    
                                   
                    $options[] = $option;
                }else{
                    $submenu = true;
                    $menu_id = $level->pivot->menu_id;
                    $menu_order = $level->pivot->order;
                    $menu = Menu::find($menu_id);
                    $description = $menu->name;
                    $option = 
                    "<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' role='button' id='dropdownMenu". $menu_order ."' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".$description."
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu". $menu_order ."'>";
                    $options[] = $option;
                }
                if($submenu == true){
                    $menu_order = $level['pivot_order'];
                    $levelx = $original_menus->where('pivot_order', $menu_order)->where('pivot_level','>',0)->sortBy('pivot_order')->all();
                    foreach ($levelx as $level) {
                        $href = Menu::find($level['pivot_menu_id'])->route;
                        $description = Menu::find($level['pivot_menu_id'])->name;
                        $option = "<li><a href='".$href."'>".$description."</a></li>";
                        $options[] = $option;
                    }
                    $options[] = "</ul></li>";
                }                
            }
            // Agrega las filas al archivo
            foreach ($options as $option) {
                fwrite($file, $option . PHP_EOL);
            }

            fwrite($file, "@endif". PHP_EOL);
        }

        /********** FIN DE OPCIONES ******/
        fwrite($file, '</ul>'. PHP_EOL);
        fwrite($file, '<!-- Right Side Of Navbar -->'. PHP_EOL);
        fwrite($file, '<ul class="nav navbar-nav navbar-right">'. PHP_EOL);
        fwrite($file, '<!-- Authentication Links -->'. PHP_EOL);
        fwrite($file, '@if (Auth::guest())'. PHP_EOL);
        fwrite($file, '<li><a href="{{ url('."'/login'".') }}">Login</a></li>'. PHP_EOL);
        fwrite($file, '<li><a href="{{ url('."'/register'".') }}">Register</a></li>'. PHP_EOL);
        fwrite($file, '@else'. PHP_EOL);
        fwrite($file, '<li class="dropdown">'. PHP_EOL);
        fwrite($file, '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name_login }} <span class="caret"></span>'. PHP_EOL);
        fwrite($file, '</a>'. PHP_EOL);

        fwrite($file, '<ul class="dropdown-menu" role="menu">'. PHP_EOL);
        fwrite($file, '<li>'. PHP_EOL);
        fwrite($file, '<a href="{{ url('."'/logout'".') }}" onclick="event.preventDefault();         document.getElementById("logout-form").submit();">Logout</a>'. PHP_EOL);

        fwrite($file, '<form id='."'logout-form'".' action="{{ url('."'/logout'".') }}" method="POST" style="display: none;">'. PHP_EOL);
        fwrite($file, '{{ csrf_field() }}'. PHP_EOL);
        fwrite($file, '</form>'. PHP_EOL);
        fwrite($file, '</li>'. PHP_EOL);
        fwrite($file, '</ul>'. PHP_EOL);
        fwrite($file, '</li>'. PHP_EOL);
        fwrite($file, '@endif'. PHP_EOL);
        fwrite($file, '</ul>'. PHP_EOL);
        fwrite($file, '</div>'. PHP_EOL);
        fwrite($file, '</div>'. PHP_EOL);
        fwrite($file, '</nav>'. PHP_EOL);

        /******************************/
        fclose($file);
        $name_file = "menus/nav.blade.php";
        rename('menus/tmp.txt',$name_file);

    }
}


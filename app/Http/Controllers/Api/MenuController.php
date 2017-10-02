<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function loadTypes()
    {
        $types = Type::all();
        $atypes = [];
        foreach ($types as $type) {
            array_push($atypes, [
                'id' => $type->id,
                'name' => $type->name
            ]);
        }
        return $atypes;
    }

    public function generar($type_id, $auth_id = 'user_id')
    {
        $type = Type::find($type_id);
        $menus = $type->menus;
        $wtype = strtolower($type->name);
        $aitems=[]; 

        foreach ($menus as $menu) {
            array_push($aitems, ['id'=>$menu->id, 
                            'name'=>$menu->name, 
                            'href'=>$menu->href,
                            'help'=>$menu->help,
                            'sw_auth'=>$menu->sw_auth,
                            'parameter'=>$menu->parameter,
                            'type_id'=>$menu->pivot->type_id,
                            'menu_id'=>$menu->pivot->menu_id,
                            'level'=>$menu->pivot->level,
                            'order'=>$menu->pivot->order]);
        }

        $opciones = collect($aitems);

        $level0 = $opciones->where('level',0);
       
        $items = [];
        foreach ($level0 as $item) {
            // Si sw_auth => prefix
            if($item['sw_auth']){
                // definir prefix
                $prefix = $wtype . '/';
            } else {
                $prefix = '';
            }
            if(!$item['href']){
                $submenu = [];
                $opcion2 = $opciones->where('level','<>',0)->where('order',$item['order']);
                $item['href'] = 'submenu';
                $item['submenu'] = [];
                foreach ($opcion2 as $opcion) {
                    // Si sw_auth => prefix
                    if($opcion['sw_auth']){
                        // definir prefix
                        $prefix = $wtype . '/';
                    } else {
                        $prefix = '';
                    }
                    $opcion['href']="/" . $prefix . $opcion['href'];
                    if($opcion['parameter']){
                        if($opcion['parameter'] == 'Auth::user()->id'){
                            $opcion['href']=$opcion['href'] . "/" . $auth_id;
                        }
                    }
//                    $opcion['href'] = $opcion['href'] . ")}}";
                    array_push($item['submenu'], $opcion);
                }
                array_push($items, $item);
            }else{
                $item['href']="/" . $prefix . $item['href'];
                if($item['parameter']){
                    if($item['parameter'] == 'Auth::user()->id'){
                        $item['href']=$item['href'] . "/" . $auth_id;
                    }
                }
//                $item['href'] = $item['href'] . ")";
                array_push($items, $item);
            }
        }
        return $items;
    }

    public function generarHelp($type_id)
    {
        $type = Type::find($type_id);
        $menus = $type->menus;
        $helps=[]; 

        foreach ($menus as $menu) {
            if($menu->pivot->level == 0){   
                array_push($helps, ['id'=>$menu->id, 
                                'name'=>$menu->name, 
                                'help'=>$menu->help, 
                                'level'=>$menu->pivot->level,
                                'order'=>$menu->pivot->order,
                            ]);
            }
        }

        return $helps;
    }
}

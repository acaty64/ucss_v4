<?php

namespace App;

use App\Acceso;
use App\Menu;
use App\Type;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $facultad_id, $cfacultad, $sede_id, $csede, $type_id, $ctype;

    public function setFacultadAttributes($id, $name)
    {
        $this->facultad_id = $id;
        $this->cfacultad = $name;
    }
    public function setSedeAttributes($id, $name)
    {
        $this->sede_id = $id;
        $this->csede = $name;
    }
    public function setTypeAttributes($id, $name)
    {
        $this->type_id = $id;
        $this->ctype = $name;
    }

    public function getNameLoginAttribute()
    {
        $rpta = $this->name;
        if ($this->sede_id) {
            $rpta = $rpta . ' (' . $this->cfacultad . ' - ' . $this->csede . ')';
        }
        if ($this->type_id) {
            $rpta = $rpta . ' (' . $this->ctype . ')' ;
        }
        return $rpta;
    }

    public function getAccederAttribute($value)
    {
        Acceso::setAccesoAttributes();
        $ok = Acceso::where('user_id', $this->id)->where('facultad_id', $this->facultad_id)->where('sede_id', $this->sede_id)->first();
        
        if (count($ok) && $this->facultad_id) {

            $type = Type::find($ok->type_id);

            Session::put('type_id',$type->id);
            Session::put('ctype',$type->name);
            Acceso::setAccesoAttributes();

            $menus = Type::find($ok->type_id)->menus;

            $original_menus = collect([]);
            foreach ($menus as $menu) {
                $original_value = $menu->original;
                $original_menus->push($original_value);
            }

            $level0 = $original_menus->where('pivot_level',0)->sortBy('pivot_order')->all();
            foreach($level0 as $level){
                if($level['href']){
                    $submenu = false;
                    $option = "<li><a href='".$level['href']."'>".$level['name']."</a></li>";
                    $options[] = $option;
                }else{
                    $submenu = true;
                    $menu_id = $level['pivot_menu_id'];
                    $menu_order = $level['pivot_order'];
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
            return $options;
        } else {
            return false;
        }
    }
/***
    public function getTypeAttribute($value='')
    {
        $type_id = $this->type_id;
        if(!$type_id){
            return false;
        }else{
            $ctype = Type::find($type_id)->name;
            return $ctype;
        }
    }

    public function getUserMenuAttribute($value='')
    {
        if($this->acceder){
            $opciones = Menu::where('type_id',$this->type_id)->get();
            return $opciones;            
        }else{
            return false;
        }

    }
*/
}

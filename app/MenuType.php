<?php

namespace App;

use App\Menu;
use App\Type;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    protected $table = 'menu_type';
    protected $fillable = [
        'type_id', 'menu_id', 'level', 'order'
    ];
/**
    public function menu(){
        return $this->hasOne(Menu::class);
    }
    public function type(){
        return $this->hasOne(Type::class);
    }
*/
    public function treeArray($type_id)
    {
        $menu_type = MenuType::where('type_id', $type_id)->sortBy('level')->sortBy('order')->all();
dd($menu_type);
        return $tree;
    }
}

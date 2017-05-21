<?php

namespace App;

use App\Acceso;
use App\Menu;
use App\Type;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	protected $table = 'types';

    protected $fillable = [
        'name'
    ];

	public function users(){
        return $this->belongsToMany(Type::class);
    }

    public function menus(){
        return $this->belongsToMany(Menu::class)
            ->withPivot('level', 'order');
    }

    public function accesos(){
        return $this->belongsToMany(Acceso::class);
    }

}

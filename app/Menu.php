<?php

namespace App;

use App\Type;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menus';

    protected $fillable = [
        'name', 'level', 'order', 'route', 'parameter'
    ];

    public function types(){
        return $this->belongsToMany(Type::class)
        	->withPivot('level', 'order');
    }
}

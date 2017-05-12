<?php

namespace App;

use App\Acceso;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
	protected $table = 'sedes';
    protected $fillable = [
        'cSede', 'wSede', 
    ];

    
}

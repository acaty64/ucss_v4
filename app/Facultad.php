<?php

namespace App;

use App\Acceso;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
	protected $table = 'facultades';
	protected $fillable = [
        'cFacultad', 'wFacultad', 
    ];

    
}

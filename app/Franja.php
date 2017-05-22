<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franja extends Model
{
	protected $table = 'franjas';
	protected $fillable = [
        'dia', 'turno', 'hora', 'wfranja', 'facultad_id', 'sede_id', 
    ];
}

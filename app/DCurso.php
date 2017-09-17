<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DCurso extends Model
{
    protected $table = 'dcursos';		
    protected $fillable = [		
        'facultad_id', 'sede_id', 'curso_id','user_id', 'prioridad', 'sw_cambio'
    ];
    protected $hidden = ['created_at', 'updated_at'];	

    /********** RELATIONSHIP ***********/
    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }	

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

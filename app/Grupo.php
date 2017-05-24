<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /************* RELATIONSHIPS *********/
    public function cursogrupo()
    {
        return $this->hasMany('App\CursoGrupo');
    }

}

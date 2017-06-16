<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Grupo extends Model
{
    /************* RELATIONSHIPS *********/
    public function cursogrupo()
    {
        return $this->hasMany('App\CursoGrupo');
    }

    /************* FUNCIONES ************/
    protected function facultadSede()
    {
    	$facultad_id = Session::get('facultad_id');
    	$sede_id = Session::get('sede_id');
    	return Grupo::where('facultad_id', $facultad_id)->where('sede_id',$sede_id)->get();
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoGrupo extends Model
{
    protected $table = 'cursogrupo';	

    /*********** RELATIONSHIP *******/
    public function grupo()
    {
        /* return $this->belongsTo('App\User', 'foreign_key'); */
        return $this->belongsTo('App\Grupo');
    }

    public function curso()
    {
        /* return $this->belongsTo('App\User', 'foreign_key'); */
        return $this->belongsTo('App\Curso');
    }
}

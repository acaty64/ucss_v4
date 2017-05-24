<?php

namespace App;

use App\Acceso;
use App\Menu;
use App\Type;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $facultad_id, $cfacultad, $sede_id, $csede, $type_id, $ctype;

    public function setFacultadAttributes($id, $name)
    {
        $this->facultad_id = $id;
        $this->cfacultad = $name;
    }
    public function setSedeAttributes($id, $name)
    {
        $this->sede_id = $id;
        $this->csede = $name;
    }
    public function setTypeAttributes($id, $name)
    {
        $this->type_id = $id;
        $this->ctype = $name;
    }

    public function getNameLoginAttribute()
    {
        $rpta = $this->name;
        if ($this->sede_id) {
            $rpta = $rpta . ' (' . $this->cfacultad . ' - ' . $this->csede . ')';
        }
        if ($this->type_id) {
            $rpta = $rpta . ' (' . $this->ctype . ')' ;
        }
        return $rpta;
    }

    public function getAccederAttribute($value)
    {
        Acceso::setAccesoAttributes();
        $ok = Acceso::where('user_id', $this->id)->where('facultad_id', $this->facultad_id)->where('sede_id', $this->sede_id)->first();
        
        if (count($ok) && $this->facultad_id) {
            Session::put('type_id',$ok->type_id);
            Session::put('ctype',$ok->type->name);
            Acceso::setAccesoAttributes();
            return true;
        } else {
            return false;
        }
    }

    /************** SCOPEs **********************/
    /** SCOPE apellido paterno */
    public function scopeSdocente($query, $wdocente){
        return $query->where('slug', 'LIKE', "%$wdocente%");
    }
    /** SCOPE tipo de usuario */
    public function scopeStype($query, $type){
        return $query->where('type', '=', "$type");
    }
    
    // Scope por nombre y tipo    
    public function scopeSearch($filter, $name, $type = null)
    {
        $filter = $filter->where('slug', "LIKE", "%$name%");
        if (!empty($type))
        {
            $filter = $filter->where('type', "LIKE", "%$type%");
        }
        return $filter;
    }

    /************* FUNCIONES ********************/
    public function wDocente($id){
        $user = User::find($id);
        return $user->wdoc2." ".$user->wdoc3.", ".$user->wdoc1;
    }

    /************ RELATIONSHIPS ******************/
    public function accesos()
    {
        return $this->hasMany('App\Acceso');
    }

    public function datauser()
    {
        return $this->hasOne('App\Datauser');
    }

    public function dcursos()
    {
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        $dcursos = $this->hasMany('App\DCurso')->where('facultad_id',$facultad_id)->where('sede_id',$sede_id);
        return $dcursos;
    }
/***
    public function getTypeAttribute($value='')
    {
        $type_id = $this->type_id;
        if(!$type_id){
            return false;
        }else{
            $ctype = Type::find($type_id)->name;
            return $ctype;
        }
    }

    public function getUserMenuAttribute($value='')
    {
        if($this->acceder){
            $opciones = Menu::where('type_id',$this->type_id)->get();
            return $opciones;            
        }else{
            return false;
        }

    }
*/
}

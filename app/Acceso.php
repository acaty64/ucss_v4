<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Acceso extends Model
{
    protected $table = 'accesos';

    protected $fillable = [
        'user_id', 'sede_id', 'facultad_id', 'type_id'
    ];

    protected function setAccesoAttributes()
    {
        if(Session::get('facultad_id')){
            Auth::User()->setFacultadAttributes(Session::get('facultad_id'), Session::get('cfacultad'));
        } 
        if(Session::get('sede_id')){
            Auth::User()->setSedeAttributes(Session::get('sede_id'), Session::get('csede'));
        } 
        if(Session::get('type_id')){
            Auth::User()->setTypeAttributes(Session::get('type_id'), Session::get('ctype'));
        }
    }

}

<?php

namespace Tests;

use App\Acceso;
use App\Facultad;
use App\Sede;
use App\Type;
use Illuminate\Support\Facades\Session;

//use Illuminate\Contracts\Console\Kernel;

trait TestsHelper
{
    protected $defaultUser;
    protected $authUser;

    public function defaultUser(array $attributes = [])
    {
        if($this->defaultUser){
            return $this->defaultUser;
        }
        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function authUser($user_id, $facultad_id, $sede_id, $type_id)
    {
    	$cfacultad = Facultad::find($facultad_id)->cfacultad;
    	$csede = Sede::find($sede_id)->csede;
    	$ctype = Type::find($type_id)->name;
    	
    	Acceso::create([
    		'user_id' => $user_id,
    		'facultad_id' => $facultad_id,
    		'sede_id' => $sede_id,
    		'type_id' => $type_id
    		]);

    	Session::put('facultad_id', $facultad_id);
    	Session::put('cfacultad', $cfacultad);
    	Session::put('sede_id', $sede_id);
    	Session::put('csede', $csede);
    	Session::put('type_id', $type_id);
    	Session::put('ctype', $ctype);
    }

}

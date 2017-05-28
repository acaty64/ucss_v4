<?php

namespace App;

use  Cviebrock\EloquentSluggable\Sluggable;
use App\Acceso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class DataUser 
extends Model
{
    
    //use Sluggable;

   	protected $table = 'datausers';		
    protected $fillable = [	
        'wdoc1',
        'wdoc2',
        'wdoc3',	
    	'cdocente',
    	'fono1',
    	'fono2',
    	'email1',
    	'email2',
        'whatsapp',
        'wdocente'
    ];

     /**
     * Get the user that owns the data.
     */
    public function user()
    {
        /* return $this->belongsTo('App\User', 'foreign_key'); */
        return $this->belongsTo('App\User');
    }	

    public function wdocente()
    {
        return $this->wdoc2 . ' ' . $this->wdoc3 . ', ' . $this->wdoc1;
    }

    protected function ctype()
    {
        return Acceso::where('user_id',$this->user_id)
                    ->where('facultad_id',Session::facultad_id)
                    ->where('sede_id',Session::sede_id)
                    ->first()->ctype();
    }

    public function newCodigo()
    {
        $codigo = DataUser::all()->sortByDesc('cdocente')->first()->cdocente;
        return $codigo + 1;        
    }
}
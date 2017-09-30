<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class DHora extends Model
{
    protected $table = 'dhoras';		
    protected $fillable = [		
    	//'semestre',
        'facultad_id',
        'sede_id',
        'user_id',
        'wfranja',
        'sw_cambio'  
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function acceso()
    {
        return $this->belongsTo('App\Acceso');
    }

    public function franja()
    {
        return $this->belongsTo('App\Franja');
    }		

    /*public function sede()
    {
        return $this->belongsTo('App\Sede');
    } 
    */  
    /** SCOPE Disponibilidad Horaria SEMESTRE actual 
    public function scopeSsemestre($query)
    {
        return $query->where('semestre', '=', \Auth::user()->semestre);
    }
*/
}

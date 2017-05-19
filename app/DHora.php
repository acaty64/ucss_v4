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
        'D1_H10' ,
        'D1_H11' ,
        'D1_H12' ,
        'D1_H13' ,
        'D1_H21' ,
        'D1_H22' ,
        'D1_H31' ,
        'D1_H32' ,
        'D1_H33' ,
        'D2_H10' ,
        'D2_H11' ,
        'D2_H12' ,
        'D2_H13' ,
        'D2_H21' ,
        'D2_H22' ,
        'D2_H31' ,
        'D2_H32' ,
        'D2_H33' ,
        'D3_H10' ,
        'D3_H11' ,
        'D3_H12' ,
        'D3_H13' ,
        'D3_H21' ,
        'D3_H22' ,
        'D3_H31' ,
        'D3_H32' ,
        'D3_H33' ,
        'D4_H10' ,
        'D4_H11' ,
        'D4_H12' ,
        'D4_H13' ,
        'D4_H21' ,
        'D4_H22' ,
        'D4_H31' ,
        'D4_H32' ,
        'D4_H33' ,
        'D5_H10' ,
        'D5_H11' ,
        'D5_H12' ,
        'D5_H13' ,
        'D5_H21' ,
        'D5_H22' ,
        'D5_H31' ,
        'D5_H32' ,
        'D5_H33' ,
        'D6_H10' ,
        'D6_H11' ,
        'D6_H12' ,
        'D6_H13' ,
        'D6_H21' ,
        'D6_H22' ,
        'D6_H31' ,
        'D6_H32' ,
        'D6_H33' ,
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

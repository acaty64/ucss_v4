<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SedeFacultad extends Model
{
    protected $table = 'sede_facultades';
    protected $fillable = [
        'sede_id', 'facultad_id'];
}

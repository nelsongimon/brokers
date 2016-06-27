<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    /*
    *
    *
    *
    */
    protected $table = 'aspirantes';
    protected $fillable = ['nombre','apellido','telefono','email','curriculum'];
}

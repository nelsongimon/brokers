<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
	/*
	*
	*
	*/
    protected $table = 'asesores';
    protected $fillable = ['nombre','apellido','telefono','email'];
    /*
    *
    *
    */
    public function inmuebles(){
    	return $this->hasMany('App\Inmueble');
    }
}

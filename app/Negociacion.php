<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negociacion extends Model
{
	/*
	*
	*
	*/
    protected $table = 'negociaciones';
    protected $fillable = ['negociacion'];
    /*
    *
    */
    public function inmuebles(){
    	return $this->hasMany('App\Inmueble');
    }
}

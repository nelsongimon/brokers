<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{	
	/*
	*
	*/
    protected $table = 'ciudades';
    protected $fillable = ['ciudad','estado_id'];
    /*
    *
    */
    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    public function inmuebles(){
    	return $this->hasMany('App\Inmueble');
    }

    public function sectores(){
    	return $this->hasMany('App\Sector');
    }
}

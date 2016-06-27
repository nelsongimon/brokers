<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
	/*
	*
	*/
    protected $table = 'sectores'; 
    protected $fillable = ['sector','ciudad_id'];
    /*
    *
    */
    public function ciudad(){
    	return $this->belongsTo('App\Ciudad');
    }

    public function inmuebles(){
    	return $this->hasMany('App\Inmueble');
    }
    
}

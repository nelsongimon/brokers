<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
	/*
	*
	*/
    protected $table = 'sectores'; 
    protected $fillable = ['sector','estado_id','ciudad_id'];
    /*
    *
    */
    public function ciudad(){
    	return $this->belongsTo('App\Ciudad');
    }

    public function estado(){
        return $this->belongsTo('App\Estado');
    }

    public function inmuebles(){
    	return $this->hasMany('App\Inmueble');
    }
    
}

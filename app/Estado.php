<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{	
	/*
	*
	*/
    protected $table= 'estados';
    protected $fillable=['estado'];
    /*
    *
    */
    public function ciudades(){
    	return $this->hasMany('App\Ciudad');
    }
    
    public function sectores(){
        return $this->hasMany('App\Sector');
    }
   
    public function inmuebles(){
    	return $this->hasMany('App\Inmueble');
    }

}

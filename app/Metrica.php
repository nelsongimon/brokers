<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metrica extends Model
{
    
    protected $table = 'metricas';


    public function inmueble(){
    	return $this->belongsTo('App\Inmueble');
    }
    
}

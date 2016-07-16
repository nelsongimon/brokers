<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    /*
    *
    *
    */
    protected $table = 'localizaciones';
    protected $fillable = ['localizacion','latitud','longitud','zoom','inmueble_id'];
    /*
    *
    *
    */
    public function inmueble(){
        return $this->belongsTo('App\Inmueble');
    }
}

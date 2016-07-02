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
    protected $fillable = ['descripcion','latitud','longitud','inmueble_id'];
    /*
    *
    *
    */
    public function inmueble(){
        return $this->belongsTo('App\Inmueble');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    /*
    *
    *
    */
    protected $table = 'imagenes';
    protected $fillable = ['imagen','principal','inmueble_id'];
    /*
    *
    *
    */
    public function inmueble(){
        return $this->belongsTo('App\Inmueble');
    }
}

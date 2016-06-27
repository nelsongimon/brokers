<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    /*
    *
    *
    */
    protected $table = 'precios';
    protected $fillable = ['bolivares','dolares','inmueble_id'];
    /*
    *
    *
    */
    public function inmueble(){
        return $this->belongsTo('App\Inmueble');
    }
}

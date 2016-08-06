<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destacado extends Model
{
    protected $table = 'destacados';
    protected $fillable = ['titulo','imagen','inmueble_id'];
    /*
    *
    *
    */
    public function inmueble(){
        return $this->belongsTo('App\Inmueble');
    }
}

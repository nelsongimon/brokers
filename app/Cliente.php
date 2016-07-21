<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='clientes';
    protected $fillable=['nombre','apellido','telefono','email','inmueble_id'];
    /*
    *
    *
    *
    */
    public function inmueble(){
        return $this->belongsTo('App\Inmueble');
    }
}

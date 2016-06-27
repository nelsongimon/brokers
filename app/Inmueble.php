<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    /*
    *
    *
    */
    protected $table = 'inmuebles';
    protected $fillable = ['titulo','descripcion','area_parcela','area_construccion','cuartos','banos','estacionamientos','status','user_id','tipo_id','negociacion_id','asesor_id','estado_id','ciudad_id','sector_id'];
    /*
    *
    *
    */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    public function ciudad(){
    	return $this->belongsTo('App\Ciudad');
    }

    public function sector(){
    	return $this->belongsTo('App\Sector');
    }

    public function asesor(){
    	return $this->belongsTo('App\Asesor');
    }

    public function tipo(){
    	return $this->belongsTo('App\Tipo');
    }

    public function negociacion(){
    	return $this->belongsTo('App\Negociacion');
    }

    public function precio(){
    	return $this->hasOne('App\Precio');
    }

    public function localizacion(){
    	return $this->hasOne('App\Localizacion');
    }

    public function imagen(){
    	return $this->hasOne('App\Imagen');
    }
}

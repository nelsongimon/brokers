<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Inmueble extends Model
{
    /*
    *
    *
    */
    use Sluggable;
    protected $table = 'inmuebles';

    protected $fillable = ['titulo','descripcion','nota','area_parcela','area_construccion','cuartos','banos','estacionamientos','status','user_id','tipo_id','negociacion_id','asesor_id','estado_id','ciudad_id','sector_id'];
    /*
    *
    *
    */
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'titulo'
            ]
        ];
    }

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

    public function localizacion(){
        return $this->hasOne('App\Cliente');
    }

    public function imagenes(){
    	return $this->hasMany('App\Imagen');
    }


}

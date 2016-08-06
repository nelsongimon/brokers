<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Slider;
use App\Destacado;
use Session;

class DestacadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $action = $request->action;

        // Obtener los valores de los inmuebles en un array
        $key = array_keys($request->all());
        $filtro = array_filter($key, function($k){
            return starts_with($k, 'id');
        });
        $filtro = implode($filtro);
        $pos = strpos($filtro,'-');
        $filtro = substr($filtro, $pos+1);
        $filtro = explode('id-', $filtro);

        
        if($action == 'slider'){
            for ($i = 0; $i < count($filtro) ; $i++) {
                $sliders = Slider::all();
                $verificacion = true;
                foreach ($sliders as $slider) {
                    if($slider->inmueble_id == $filtro[$i]){
                        $verificacion = false;
                    }               
                }
                if($verificacion){
                    $inmueble = Inmueble::find($filtro[$i]);
                    $slider = new Slider;
                    $slider->titulo = $inmueble->titulo;
                    $slider->inmueble_id = $inmueble->id;
                    foreach ($inmueble->imagenes as $imagen) {
                        if($imagen->principal == 'yes'){
                            $slider->imagen = $imagen->imagen;
                        }
                    }
                    $slider->save();
                }
            }

            Session::flash('mensaje-success','Se han añadido los inmuebles al slider con éxito');
        }

        if($action == 'destacados'){
            for ($i = 0; $i < count($filtro) ; $i++) {
                $destacados = Destacado::all();
                $verificacion = true;
                foreach ($destacados as $destacado) {
                    if($destacado->inmueble_id == $filtro[$i]){
                        $verificacion = false;
                    }               
                }
                    
                if($verificacion){ 
                    $inmueble = Inmueble::find($filtro[$i]);
                    $destacado = new Destacado;
                    $destacado->titulo = $inmueble->titulo;
                    $destacado->inmueble_id = $inmueble->id;
                    foreach ($inmueble->imagenes as $imagen) {
                        if($imagen->principal == 'yes'){
                            $destacado->imagen = $imagen->imagen;
                        }
                    }
                    $destacado->save();
                    
                }
            }

            
            Session::flash('mensaje-success','Se han añadido los inmuebles a destacados con éxito');
        }
        
        return redirect('admin/inmuebles');
 
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Tipo;
use App\Negociacion;
use App\Asesor;
use App\Estado;
use App\Ciudad;
use App\Sector;
use App\Precio;
use App\Localizacion;
use App\Imagen;
use App\DolarValor;
use Auth;
use Session;
use Image;


class InmueblesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $inmuebles=Inmueble::all();
        $dolar_valor=DolarValor::all();
        $valor=$dolar_valor->last()->valor;

        return view('admin.inmuebles.index',['inmuebles'=>$inmuebles,'valor'=>$valor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asesores=Asesor::orderBy('nombre','asc')->get();
        $tipos=Tipo::orderBy('id','asc')->get();
        $negos=Negociacion::orderBy('id','asc')->get();
        $estados=Estado::orderBy('estado','asc')->get();

        return view('admin.inmuebles.create',[
            'asesores'=>$asesores,
            'tipos'=>$tipos,
            'negos'=>$negos,
            'estados'=>$estados
            ]);
    }
    /*
    *
    *
    *
    *
    **/
    public function createLocalizacion(){

        return view('admin.inmuebles.createLocalizacion');
    }
    /*
    *
    *
    *
    **/
    public function storeLocalizacion(Request $request){

        
        $inmuebles=Inmueble::all();
        
        $localizacion= new Localizacion;

        $localizacion->localizacion=$request->localizacion;
        $localizacion->latitud=$request->latitud;
        $localizacion->longitud=$request->longitud;
        $localizacion->zoom=$request->zoom;
        $localizacion->inmueble_id=$inmuebles->last()->id;
        $localizacion->save();

        $inmueble=Inmueble::find($inmuebles->last()->id);

        Session::flash('mensaje-success','El inmueble '. $inmueble->titulo .' fue creado con éxito');
        return redirect('/admin/inmuebles');
        

    }
    /*
    *
    *
    *
    *
    **/
    public function storeImagenPrincipal(Request $request){

        $inmuebles=Inmueble::all();

        $file=$request->file('foto');
        $image = Image::make($file);
        $file_name = 'Principal_'.time().'_'.$file->getClientOriginalName();
        $path=public_path().'/images/inmuebles/';
        $image->save($path.$file_name);

        //Redimensionar la imagen
        $dimensiones=getimagesize(asset('images/inmuebles').'/'.$file_name);
        $ancho=$dimensiones[0]; //Ancho
        $alto=$dimensiones[1]; //Alto
        if($ancho > 300){
            $pro=$ancho/300;
            $alto=$alto/$pro;
            $image->resize(300,$alto);
            $image->save($path.'Thumb_'.$file_name);
        }

        $imagen= new Imagen;
        $imagen->imagen = $file_name;
        $imagen->principal = 'yes';
        $imagen->inmueble_id = $inmuebles->last()->id;  
        $imagen->save();  
        
    }
    /*
    *
    *
    *
    **/
    public function storeImagenesRestantes(Request $request){

        $inmuebles=Inmueble::all();
        $file=$request->file('foto');
        $file_name = time().'_'.$file->getClientOriginalName();
        $path=public_path().'/images/inmuebles';
        $file->move($path,$file_name);

        $imagen= new Imagen;
        $imagen->imagen = $file_name;
        $imagen->principal = 'no';
        $imagen->inmueble_id = $inmuebles->last()->id;   
        $imagen->save();

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $inmueble=Inmueble::create($request->all());
        if(isset($request->status)){
            $inmueble->status='vendido';
            $inmueble->save();
        }

        $precio= new Precio;
        $precio->dolares=$request->dolares;
        $precio->inmueble()->associate($inmueble);
        $precio->save();

        //return $this->id;
        return view('admin.inmuebles.createImagenes');
        



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inmueble=Inmueble::find($id);
        return view('admin.inmuebles.show',['inmueble'=>$inmueble]);
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

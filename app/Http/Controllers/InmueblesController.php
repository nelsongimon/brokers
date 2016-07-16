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
use Auth;


class InmueblesController extends Controller
{

    protected $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewImagenes()
    {
        return view('admin.inmuebles.createImagenes',['id'=>1]);
    }
    /*
    *
    *
    *
    **/
    public function index()
    {
        return 'hola';
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

        $localizacion= new Localizacion;

        $localizacion->localizacion=$request->localizacion;
        $localizacion->latitud=$request->latitud;
        $localizacion->longitud=$request->longitud;
        $localizacion->zoom=$request->zoom;
        $localizacion->inmueble_id=$this->id;
        $localizacion->save();

        $inmueble=Inmueble::find($this->id);

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

        $file=$request->file('foto');
        $file_name = 'Principal_'.time().'_'.$file->getClientOriginalName();
        $path=public_path().'/images/inmuebles';
        $file->move($path,$file_name);

        $imagen= new Imagen;
        $imagen->imagen = $file_name;
        $imagen->principal = 'yes';
        $imagen->inmueble_id = $this->id;  
        //$imagen->save();  
        
    }
    /*
    *
    *
    *
    **/
    public function storeImagenesRestantes(Request $request){

        $file=$request->file('foto');
        $file_name = time().'_'.$file->getClientOriginalName();
        $path=public_path().'/images/inmuebles';
        $file->move($path,$file_name);

        $imagen= new Imagen;
        $imagen->imagen = $file_name;
        $imagen->principal = 'no';
        $imagen->inmueble_id = $this->id;  
        //$imagen->save();

        
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
        $precio->bolivares=$request->bolivares;
        $precio->inmueble()->associate($inmueble);
        $precio->save();
        $this->id=$inmueble->id;
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

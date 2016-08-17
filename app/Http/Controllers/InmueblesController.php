<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreInmueblesRequest;
use App\Http\Requests\UpdateInmueblesRequest;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Tipo;
use App\Negociacion;
use App\Asesor;
use App\Estado;
use App\Ciudad;
use App\Sector;
use App\Localizacion;
use App\Imagen;
use App\DolarValor;
use App\Cliente;
use App\Metrica;
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
        $inmuebles=Inmueble::orderBy('id','desc')->get();
        $dolar_valor=DolarValor::all();
        $valor=$dolar_valor->last()->valor;

        return view('admin.inmuebles.index',['inmuebles' => $inmuebles,'valor' => $valor]);
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
            'asesores' => $asesores,
            'tipos'    => $tipos,
            'negos'    => $negos,
            'estados'  => $estados
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

        Session::flash('mensaje-success','El inmueble fue creado con éxito');
        return redirect('/admin/inmuebles');
        

    }
    /*
    *
    *
    *
    */
    public function createImagenes(){

        return view('admin.inmuebles.createImagenes');
    }
    /*
    *
    *
    *
    *
    **/
    public function storeImagenes(Request $request){


        
        $files=$request->file('foto');
        $count=0;
        foreach($files as $file){
            
            if($count==0){
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
                $inmuebles=Inmueble::all();
                $imagen= new Imagen;
                $imagen->imagen = $file_name;
                $imagen->principal = 'yes'; 
                $imagen->inmueble_id = $inmuebles->last()->id;
                $imagen->save();
            }
            else{

                $image = Image::make($file);
                $file_name = time().'_'.$file->getClientOriginalName();
                $path=public_path().'/images/inmuebles/';
                $image->save($path.$file_name);

                $inmuebles=Inmueble::all();
                $imagen= new Imagen;
                $imagen->imagen = $file_name;
                $imagen->principal = 'no'; 
                $imagen->inmueble_id = $inmuebles->last()->id;
                $imagen->save();               
            }

            $count++;

        } 
        
        
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInmueblesRequest $request)
    {
        
        $inmueble = Inmueble::create($request->all());
        $inmueble->dolares = $request->dolares;

        $valor = DolarValor::all();

        $inmueble->bolivares = ($request->dolares * $valor->last()->valor);
        $inmueble->save();

        if(isset($request->status)){
            $inmueble->status='yes';
            $inmueble->save();
        }
        else{
            $inmueble->status = 'no';
            $inmueble->save();
        }

        $cliente = new Cliente;
        $cliente->nombre=$request->nombre;
        $cliente->apellido=$request->apellido;
        $cliente->telefono=$request->telefono;
        $cliente->email=$request->email;
        $cliente->inmueble()->associate($inmueble);
        $cliente->save();

        return redirect('admin/inmuebles/create/imagenes');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $inmueble = Inmueble::find($id);

        if(!$inmueble){
            abort(404);
        }

        return view('admin.inmuebles.show',['inmueble' => $inmueble]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inmueble = Inmueble::find($id);
        $asesores = Asesor::orderBy('nombre','asc')->get();
        $tipos = Tipo::orderBy('id','asc')->get();
        $negos = Negociacion::orderBy('id','asc')->get();
        $estados = Estado::orderBy('estado','asc')->get();

        if(!$inmueble){
            abort(404);
        }

        return view('admin.inmuebles.edit',[
            'inmueble' => $inmueble,
            'asesores' => $asesores,
            'tipos'    => $tipos,
            'negos'    => $negos, 
            'estados'  => $estados
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInmueblesRequest $request,$id)
    {
      
        $inmueble = Inmueble::find($id);

        $inmueble->titulo = $request->titulo;
        $inmueble->descripcion = $request->descripcion;
        $inmueble->nota = $request->nota;
        $inmueble->area_parcela = $request->area_parcela;
        $inmueble->tipo_id = $request->tipo_id;
        $inmueble->area_construccion = $request->area_construccion;
        $inmueble->negociacion_id = $request->negociacion_id;
        $inmueble->cuartos = $request->cuartos;
        $inmueble->banos = $request->banos;
        $inmueble->estado_id = $request->estado_id;
        $inmueble->ciudad_id = $request->ciudad_id;
        $inmueble->sector_id = $request->sector_id;
        $inmueble->estacionamientos = $request->estacionamientos;
        $inmueble->asesor_id = $request->asesor_id;
        $inmueble->user_id = $request->user_id;



        $inmueble->dolares = $request->dolares;
        $valor = DolarValor::all();
        $inmueble->bolivares = ($request->dolares * $valor->last()->valor);

        $inmueble->localizacion->localizacion = $request->localizacion;
        $inmueble->localizacion->latitud = $request->latitud;
        $inmueble->localizacion->longitud = $request->longitud;
        $inmueble->localizacion->zoom = $request->zoom;

        $inmueble->cliente->nombre = $request->nombre;
        $inmueble->cliente->apellido = $request->apellido;
        $inmueble->cliente->telefono = $request->telefono;
        $inmueble->cliente->email = $request->email;

        //Guardado del modelo inmueble y sus relaciones
        $inmueble->save();
        $inmueble->push();

        Session::flash('mensaje-success','El inmueble se ha actualizado con éxito');
        return redirect('/admin/inmuebles');

    }
    /*
    *
    *
    *
    **/
    public function editImagenes(Request $request){

        return view('admin.inmuebles.editImagenes',['id'=>$request->id]);
        
    }
    /*
    *
    *
    *
    **/
    public function updateImagenes(Request $request){
        //borrado de imagenes
        $inmueble=Inmueble::find($request->id);
        $files=$inmueble->imagenes;
        foreach($files as $file){
            //Borrado de la imagen
            if($file->principal=="yes"){
                unlink(public_path().'/images/inmuebles/'.$file->imagen);
                unlink(public_path().'/images/inmuebles/Thumb_'.$file->imagen);
            }
            else{
                unlink(public_path().'/images/inmuebles/'.$file->imagen);
            } 
            
            $file->delete();           
        }

        // Carga del nuevo grupo de imagenes
        $files=$request->file('foto');
        $count=0;
        foreach($files as $file){
            
            if($count==0){
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
                $imagen->inmueble_id = $request->id; 
                $imagen->save();
            }
            else{

                $image = Image::make($file);
                $file_name = time().'_'.$file->getClientOriginalName();
                $path=public_path().'/images/inmuebles/';
                $image->save($path.$file_name);

                $imagen=new Imagen;
                $imagen->imagen = $file_name;
                $imagen->principal = 'no'; 
                $imagen->inmueble_id = $request->id; 
                $imagen->save();                
            }

            $count++;

        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $inmueble=Inmueble::find($id);
       $files=$inmueble->imagenes;
       foreach($files as $file){
            //Borrado de la imagen
            if($file->principal=="yes"){
                unlink(public_path().'/images/inmuebles/'.$file->imagen);
                unlink(public_path().'/images/inmuebles/Thumb_'.$file->imagen);
            }
            else{
                unlink(public_path().'/images/inmuebles/'.$file->imagen);
            }
                        
       }

        $inmueble->delete();
        Session::flash('mensaje-success','El Inmueble se ha eliminado con éxito');
        return redirect('/admin/inmuebles');
    }
    /*
    *
    *
    *
    */
    public function updateStatus(Request $request){
        $inmueble=Inmueble::find($request->id);
        if($inmueble->status=='yes'){
            $inmueble->status='no';
            $inmueble->save();
        }
        else{
            $inmueble->status='yes';
            $inmueble->save();
        }
        return response()->json([
            'status'=>$inmueble->status
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreAsesoresRequest;
use App\Http\Requests\UpdateAsesoresRequest;
use App\Http\Controllers\Controller;
use App\Asesor;
use Session;
use Image;

class AsesoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asesores=Asesor::all();
        return view('admin.asesores.index',['asesores'=>$asesores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asesores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsesoresRequest $request)
    {
        //Manipulacion de imagen
        $file=$request->file('foto');
        $image=Image::make($request->file('foto'));
        $file_name=time().'_'.$file->getClientOriginalName();
        $path=public_path().'/images/asesores/';
        $image->save($path.$file_name);

        //Redimensionar la imagen
        $dimensiones=getimagesize(asset('images/asesores').'/'.$file_name);
        $ancho=$dimensiones[0]; //Ancho
        $alto=$dimensiones[1]; //Alto
        if($ancho > 400){
            $pro=$ancho/400;
            $alto=$alto/$pro;
            $image->resize(400,$alto);
            $image->save($path.$file_name);
        }

        //fin de la manipulacion de imagen
        
        $asesor=Asesor::create($request->all());
        $asesor->foto=$file_name;
        $asesor->save();
        Session::flash('mensaje-success','El Asesor '
            .$asesor->nombre.' '.$asesor->apellido. ' se ha añadido con éxito');
        return redirect('/admin/asesores');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asesor=Asesor::find($id);

        return response()->json([
                'nombre'    => $asesor->nombre,
                'apellido'  => $asesor->apellido,
                'telefono'  => $asesor->telefono,
                'email'     => $asesor->email,
                'foto'      => asset('images/asesores/'.$asesor->foto),
                'inmuebles' => count($asesor->inmuebles)

            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asesor=Asesor::find($id);

        return response()->json([
                'nombre'   => $asesor->nombre,
                'apellido' => $asesor->apellido,
                'telefono' => $asesor->telefono,
                'email'    => $asesor->email,
                'id'       => $asesor->id
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsesoresRequest $request, $id)
    {
        $asesor=Asesor::find($request->id);
        $asesor->fill($request->all());

        //Actualizacion de la imagen
        if($request->file('foto')){

            unlink(public_path().'/images/asesores/'.$asesor->foto);
            //Manipulacion de imagen
            $file=$request->file('foto');
            $image=Image::make($request->file('foto'));
            $file_name=time().'_'.$file->getClientOriginalName();
            $path=public_path().'/images/asesores/';
            $image->save($path.$file_name);

            //Redimensionar la imagen
            $dimensiones=getimagesize(asset('images/asesores').'/'.$file_name);
            $ancho=$dimensiones[0]; //Ancho
            $alto=$dimensiones[1]; //Alto
            if($ancho > 400){
                $pro=$ancho/400;
                $alto=$alto/$pro;
                $image->resize(400,$alto);
                $image->save($path.$file_name);
            }
            $asesor->foto = $file_name;
        }

        $asesor->save();

        Session::flash('mensaje-success','El Asesor '
            .$asesor->nombre.' '.$asesor->apellido.' se ha modificado con éxito');
        return redirect('/admin/asesores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asesor=Asesor::find($id);
        //Borrado de la imagen
        if(unlink(public_path().'/images/asesores/'.$asesor->foto)){

            $asesor->delete();
            Session::flash('mensaje-success','El Asesor '
                .$asesor->nombre.' '.$asesor->apellido.' se ha eliminado con éxito');
            return redirect('/admin/asesores');
        }

    }
}

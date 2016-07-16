<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Asesor;
use Session;

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
    public function store(Request $request)
    {
        //Manipulacion de imagen
        $file=$request->file('foto');
        $file_name=time().'_'.$file->getClientOriginalName();
        $path=public_path().'/images/asesores';
        $file->move($path,$file_name);
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
                'nombre'=>$asesor->nombre,
                'apellido'=>$asesor->apellido,
                'telefono'=>$asesor->telefono,
                'email'=>$asesor->email,
                'foto'=>asset('images/asesores/'.$asesor->foto)

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
                'nombre'=>$asesor->nombre,
                'apellido'=>$asesor->apellido,
                'telefono'=>$asesor->telefono,
                'email'=>$asesor->email,
                'id'=>$asesor->id
            ]);
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
        $asesor=Asesor::find($request->id);
        $asesor->fill($request->all());
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

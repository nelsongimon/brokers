<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estado;
use Session;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados=Estado::paginate(10);
        return view('admin.localizacion.estados.index',['estados'=>$estados]);
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
        $estado=Estado::create($request->all());
        Session::flash('mensaje-success',$estado->estado.' fue creado con éxito');
        return redirect('admin/localizacion/estados');
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
        $estado=Estado::find($id);
        return response()->json([
            'estado'=>$estado->estado,
            'id'=>$estado->id
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estado=Estado::find($request->id);
        $estado->fill($request->all());
        $estado->save();
        Session::flash('mensaje-success',$estado->estado.' fue actualizado con éxito');
        return redirect('admin/localizacion/estados');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado=Estado::find($id);
        $estado->delete();
        Session::flash('mensaje-success',$estado->estado.' fue eliminado con éxito');
        return redirect('admin/localizacion/estados');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreCiudadesRequest;
use App\Http\Requests\UpdateCiudadesRequest;
use App\Http\Controllers\Controller;
use App\Ciudad;
use App\Estado;
use Session;

class CiudadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades=Ciudad::paginate(10);
        $estados=Estado::orderBy('estado', 'asc')->get();
        return view('admin.localizacion.ciudades.index',['ciudades'=>$ciudades,'estados'=>$estados]);
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
    public function store(StoreCiudadesRequest $request)
    {
        //dd($request->all());
        $ciudad=Ciudad::create($request->all());
        Session::flash('mensaje-success',$ciudad->ciudad.' fue creado con éxito');
        return redirect('admin/localizacion/ciudades');
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
        $ciudad=Ciudad::find($id);
        return response()->json([
            'ciudad'=>$ciudad->ciudad,
            'id'=>$ciudad->id
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCiudadesRequest $request)
    {
        $ciudad=Ciudad::find($request->id);
        $ciudad->fill($request->all());
        $ciudad->save();
        Session::flash('mensaje-success', $ciudad->ciudad.' fue actualizado con éxito');
        return redirect('admin/localizacion/ciudades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ciudad=Ciudad::find($id);
        $ciudad->delete();
        Session::flash('mensaje-success', $ciudad->ciudad.' fue eliminada con éxito');
        return redirect('admin/localizacion/ciudades');

    }
}

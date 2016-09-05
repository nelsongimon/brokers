<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreSectoresRequest;
use App\Http\Controllers\Controller;
use App\Sector;
use App\Ciudad;
use App\Estado;
use Session;

class SectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores=Sector::paginate(10);
        $estados=Estado::orderBy('estado','asc')->get();
        return view('admin.localizacion.sectores.index',['sectores'=>$sectores,'estados'=>$estados]);
    }
    /*
    *
    *
    *
    **/
    public function estadosCiudades(Request $request){
        
        if(empty($request->id)){
            return response()->json([
                'mensaje'=>'error'
            ]);
            exit();
        }
        
        $ciudades = Ciudad::where('estado_id','=',$request->id)->orderBy('ciudad','asc')->get();
        return response()->json([
            'ciudades' => $ciudades
            ]);
    }
    /*
    *
    *
    *
    **/
    public function ciudadesSectores(Request $request){
        
        if(empty($request->id)){
            return response()->json([
                'mensaje'=>'error'
            ]);
            exit();
        }
        
        $sectores = Sector::where('ciudad_id','=',$request->id)->orderBy('sector','asc')->get();
        return response()->json([
            'sectores' => $sectores
            ]);
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
    public function store(StoreSectoresRequest $request)
    {
        $sector=Sector::create($request->all());
        Session::flash('mensaje-success',$sector->sector.' fue creado con éxito');
        return redirect('admin/localizacion/sectores');
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
        $sector=Sector::find($id);
        return response()->json([
                'sector'=>$sector->sector,
                'id'=>$sector->id
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
        $sector=Sector::find($request->id);
        $sector->sector=$request->sector;
        $sector->save();
        Session::flash('mensaje-success',$sector->sector.' fue actualizado con éxito');
        return redirect('admin/localizacion/sectores');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector=Sector::find($id);
        $sector->delete();
        Session::flash('mensaje-success',$sector->sector.' fue eliminado con éxito');
        return redirect('admin/localizacion/sectores');
    }
}

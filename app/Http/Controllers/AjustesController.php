<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateNegociacionRequest;
use App\Http\Requests\CreateTiposRequest;
use App\Http\Requests\CreateDolarRequest;
use App\Http\Controllers\Controller;
use App\DolarValor;
use App\Tipo;
use App\Negociacion;
use App\Slider;
use App\Destacado;
use Session;

class AjustesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function mostrarPrecioDolar(){

        $valor=DolarValor::all();
        if(count($valor) < 1){
            $valor= new DolarValor;
            $valor->valor = 0;
            $valor->save();
        }
        $valor=DolarValor::all();

        return view('admin.ajustes.mostrarPrecioDolar',['precio' => $valor]);

    }
    /*
    *
    *
    *
    **/
    public function updatePrecioDolar(CreateDolarRequest $request){
        $dolar=DolarValor::find($request->id);
        $dolar->fill($request->all());
        $dolar->save();
        return response()->json([
            'mensaje'  => 'exito',
            'valor'    => $dolar->valor,
            'id'       => $dolar->id
            ]);
    }
    /*
    *
    *
    *
    *
    **/
    public function mostrarTipos(){

        $tipos=Tipo::paginate(10);
        return view('admin.ajustes.mostrarTipos',['tipos' => $tipos]);
    }
    /*
    *
    *
    *
    */
    public function createTipos(CreateTiposRequest $request){

        $tipo=Tipo::create($request->all());
        Session::flash('mensaje-success',$tipo->tipo.' fue creado con éxito');
        return redirect('admin/ajustes/tipos-de-inmuebles');
    }
    /*
    *
    *
    *
    **/
    public function editTipos(Request $request){

        $tipo=Tipo::find($request->id);
        return response()->json([
            'tipo' => $tipo->tipo,
            'id'   => $tipo->id
            ]);
    }
    /*
    *
    *
    *
    **/
    public function updateTipos(CreateTiposRequest $request){
        $tipo=Tipo::find($request->id);
        $tipo->fill($request->all());
        $tipo->save();
        Session::flash('mensaje-success',$tipo->tipo.' fue creado con éxito');
        return redirect('admin/ajustes/tipos-de-inmuebles');
    }
    /*
    *
    *
    *
    *
    **/
    public function deleteTipos($id){
        $tipo=Tipo::find($id);
        $tipo->delete();
        Session::flash('mensaje-success',$tipo->tipo.' fue eliminado con éxito');
        return redirect('admin/ajustes/tipos-de-inmuebles');

    }
    /*
    *
    *
    *
    *
    *
    **/
    public function mostrarNegociacion(){

        $negos=Negociacion::paginate(10);
        return view('admin.ajustes.mostrarNegociaciones',['negos'=>$negos]);
    }
    /*
    *
    *
    *
    */
    public function createNegociacion(CreateNegociacionRequest $request){

        $nego=Negociacion::create($request->all());
        Session::flash('mensaje-success',$nego->negociacion.' fue creado con éxito');
        return redirect('admin/ajustes/tipos-de-negociacion');
    }
    /*
    *
    *
    *
    **/
    public function editNegociacion(Request $request){

        $nego=Negociacion::find($request->id);
        return response()->json([
            'negociacion' => $nego->negociacion,
            'id'          => $nego->id
            ]);
    }
    /*
    *
    *
    *
    **/
    public function updateNegociacion(CreateNegociacionRequest $request){
        $nego=Negociacion::find($request->id);
        $nego->fill($request->all());
        $nego->save();
        Session::flash('mensaje-success',$nego->negociacion.' fue editado con éxito');
        return redirect('admin/ajustes/tipos-de-negociacion');
    }
    /*
    *
    *
    *
    *
    **/
    public function deleteNegociacion($id){
        $nego=Negociacion::find($id);
        $nego->delete();
        Session::flash('mensaje-success',$nego->negociacion.' fue eliminado con éxito');
        return redirect('admin/ajustes/tipos-de-negociacion');

    }
    /*
    *
    *
    *
    */
    public function mostrarSlider(){

        $sliders = Slider::paginate(10);
        return view('admin.ajustes.mostrarSlider',['sliders' => $sliders]);
    }
    /*
    *
    *
    *
    */
    public function mostrarDestacados(){

        $destacados = Destacado::paginate(10);
        return view('admin.ajustes.mostrarDestacados',['destacados' => $destacados]);
    }

}

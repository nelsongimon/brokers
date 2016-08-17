<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdatePerfilRequest;
use App\Http\Controllers\Controller;
use App\Metrica;
use App\Inmueble;
use App\DolarValor;
use App\Asesor;
use App\User;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $metricas = Metrica::orderBy('visitas','desc')->limit(7)->get();
        $inmuebles = Inmueble::all();
        $dolar = DolarValor::find(1);
        $asesores = Asesor::all();

        return view('admin.escritorio.index',[
            'metricas'  => $metricas,
            'inmuebles' => count($inmuebles),
            'dolar'     => $dolar,
            'asesores'  => count($asesores)
            ]);
    }
    /*
    *
    *
    *
    *
    */
    public function perfil(){

        $usuario = User::find(Auth::user()->id);
        return view('admin.escritorio.perfil', ['usuario' => $usuario]);
    }
    /*
    *
    *
    *
    */
    public function updatePerfil(UpdatePerfilRequest $request){

        $usuario = User::find($request->id);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->perfil = $request->perfil;

        if(!empty($request->password)){

            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        Session::flash('mensaje-success','Su perfil se ha actualizado con éxito');
        return redirect('/admin/home');

    }

 
}

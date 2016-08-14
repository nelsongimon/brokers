<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Metrica;
use App\Inmueble;
use App\DolarValor;
use App\Asesor;

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

        return view('admin.escritorio.perfil');
    }

 
}

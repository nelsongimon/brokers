<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Estado;
use Session;
use DB;

class FrontController extends Controller
{
    /*
    *
    *
    *
    **/
    public function __construct(){
        
        $this->middleware('guest',['only'=>'login']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.inicio');
    }
    /*
    *
    *
    *
    **/
    public function busquedaAvanzada(){

        return view('front.busquedaAvanzada');
    }
    /**
    *
    *
    *
    **/
    public function resultados(){

        return view('front.resultados');
    }
    /*
    *
    *
    *
    **/
    public function detallesInmuebles(){

        return view('front.detallesInmuebles');
    }
    /*
    *
    *
    **/
    public function busquedaRapida(Request $request){

        $inmuebles = DB::table('inmuebles')
            ->join('estados','inmuebles.estado_id','=','estados.id')
            ->join('ciudades','inmuebles.estado_id','=','ciudades.id')
            ->join('sectores','inmuebles.estado_id','=','sectores.id')
            ->join('tipos','inmuebles.estado_id','=','tipos.id')
            ->where('titulo','LIKE','%'.$request->busqueda.'%')
            ->orWhere('estado','LIKE','%'.$request->busqueda.'%')
            ->orWhere('ciudad','LIKE','%'.$request->busqueda.'%')
            ->orWhere('sector','LIKE','%'.$request->busqueda.'%')
            ->orWhere('tipo','LIKE','%'.$request->busqueda.'%')
            ->get();

        //return dd($inmuebles[0]['titulo']);

            foreach ($inmuebles as $inmueble) {
                echo $inmueble->titulo;
            }
    }
    /*
    *
    *
    *
    **/
    public function login(){
        
        return view('front.login');
    }
    /*
    *
    *
    *
    **/
    public function loginAuth(LoginRequest $request){
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            Session::flash('mensaje-success', 'Bienvenido '.Auth::user()->nombre.' '.Auth::user()->apellido);
            return redirect('admin/home');
        }
        Session::flash('mensaje-error','Email y/o password incorrectos');
        return redirect('/login');


    }
    /*
    *
    *
    *
    **/
    public function logout(){
        Auth::logout();
        Session::flash('mensaje-success', 'Su sesión se ha cerrado con éxito');
        return redirect('/login');

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
        //
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

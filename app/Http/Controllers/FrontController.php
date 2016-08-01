<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Estado;
use App\Negociacion;
use App\Tipo;
use App\Precio;
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

        $estados = Estado::all();
        $tipos = Tipo::all();
        $negos = Negociacion::all();
        $min_precio = Precio::orderBy('dolares','asc')->limit(1)->lists('dolares');
        $max_precio = Precio::orderBy('dolares','desc')->limit(1)->lists('dolares');

        //Calculo de los valores iniciales del rango
        $dif = $max_precio[0] - $min_precio[0];
        $min_star = $min_precio[0] + $dif/2 - $dif/4;
        $max_star = $max_precio[0] - $dif/2 + $dif/4;



        return view('front.busquedaAvanzada',[
            'estados'    => $estados,
            'tipos'      => $tipos,
            'negos'      => $negos,
            'min_precio' => $min_precio[0],
            'max_precio' => $max_precio[0],
            'min_star'   => $min_star,
            'max_star'   => $max_star
            ]);
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

        //Consulta para la busqueda rapida
        $results = DB::table('inmuebles')
            ->join('estados','inmuebles.estado_id','=','estados.id')
            ->join('ciudades','inmuebles.ciudad_id','=','ciudades.id')
            ->join('sectores','inmuebles.sector_id','=','sectores.id')
            ->join('tipos','inmuebles.tipo_id','=','tipos.id')
            ->where('estados.estado','LIKE','%'.$request->busqueda.'%')
            ->orWhere('ciudades.ciudad','LIKE','%'.$request->busqueda.'%')
            ->orWhere('sectores.sector','LIKE','%'.$request->busqueda.'%')
            ->orWhere('tipos.tipo','LIKE','%'.$request->busqueda.'%')
            ->lists('inmuebles.id');
        
        //Ejecutar la consulta del modelo 
        if(!empty($results)){

            $inmuebles = Inmueble::find($results);
        }
        else{

            $inmuebles = false;
        }

        $estados = Estado::all();
        $negos = Negociacion::all();
        $tipos = Tipo::all();
        $banos = $this->cantidadFiltro('banos');
        $cuartos = $this->cantidadFiltro('cuartos');

        return view('front.resultados',[
            'inmuebles' => $inmuebles,
            'cantidad'  => count($results),
            'estados'   => $estados,
            'negos'     => $negos,
            'tipos'     => $tipos,
            'banos'     => $banos,
            'cuartos'   => $cuartos
            ]);

    }
    /*
    *
    *------------------------------------------------------------------------------
    *
    *
    **/
    public function busqueda(Request $request){


        $estado_id = $request->estado_id;
        $ciudad_id = $request->ciudad_id;
        $sector_id = $request->sector_id;
        $tipo_id = $request->tipo_id;
        $negociacion_id = $request->negociacion_id;
        $cuartos = $request->cuartos;
        $banos = $request->banos;
        $estacionamientos = $request->estacionamientos;
        $minimo = str_replace('.','',$request->minimo);
        $maximo = str_replace('.','',$request->maximo);
 
        //Consulta para la busqueda Avanzada
        $results = DB::table('inmuebles')
            ->join('estados','inmuebles.estado_id','=','estados.id')
            ->join('ciudades','inmuebles.ciudad_id','=','ciudades.id')
            ->join('sectores','inmuebles.sector_id','=','sectores.id')
            ->join('tipos','inmuebles.tipo_id','=','tipos.id')
            ->join('negociaciones','inmuebles.negociacion_id','=','negociaciones.id')
            ->join('precios','inmuebles.id','=','precios.inmueble_id')
            ->where(function($query) use ($estado_id){
                if(!empty($estado_id)){
                    $query->where('estados.id','=',$estado_id);
                }
            })
            ->where(function($query) use ($ciudad_id){
                if(!empty($ciudad_id)){
                    $query->where('ciudades.id','=',$ciudad_id);
                }
            })
            ->where(function($query) use ($sector_id){
                if(!empty($sector_id)){
                    $query->where('sectores.id','=',$sector_id);
                }
            })
            ->where(function($query) use ($tipo_id){
                if(!empty($tipo_id)){
                    $query->where('tipos.id','=',$tipo_id);
                }
            })
            ->where(function($query) use ($negociacion_id){
                if(!empty($negociacion_id)){
                    $query->where('negociaciones.id','=',$negociacion_id);
                }
            })
            ->where(function($query) use ($cuartos){
                if(!empty($cuartos)){
                    $query->where('inmuebles.cuartos','=',$cuartos);
                }
            })
            ->where(function($query) use ($banos){
                if(!empty($banos)){
                    $query->where('inmuebles.banos','=',$banos);
                }
            })
            ->where(function($query) use ($estacionamientos){
                if(!empty($estacionamientos)){
                    $query->where('inmuebles.estacionamientos','=',$estacionamientos);
                }
            })
            ->whereBetween('precios.dolares', [$minimo, $maximo])
            ->lists('inmuebles.id');


        
        //Ejecutar la consulta del modelo 
        if(!empty($results)){

            $inmuebles = Inmueble::find($results);
        }
        else{

            $inmuebles = false;
            exit;
        }

        //Carga de datos para los filtros
        $estados = Estado::all();
        $negos = Negociacion::all();
        $tipos = Tipo::all();
        $banos = $this->cantidadFiltro('banos');
        $cuartos = $this->cantidadFiltro('cuartos');

        return view('front.resultados',[
            'inmuebles' => $inmuebles,
            'cantidad'  => count($results),
            'estados'   => $estados,
            'negos'     => $negos,
            'tipos'     => $tipos,
            'banos'     => $banos,
            'cuartos'   => $cuartos
            ]);
    }
    /*
    *
    *---------------------------------------------------------------------
    *
    **/
    public function cantidadFiltro($atributo){

        $inmuebles = Inmueble::all();
        foreach ($inmuebles as $inmueble) {
            $todos[] = $inmueble->$atributo;
        }
        //Ordena el array
        sort($todos);
        //Elimina la duplicidad de valores;
        $numeros = array_unique($todos);
        sort($numeros);
        for($i = 0; $i < count($numeros); $i++){
            $cantidad = 0;
            for($j = 0; $j < count($todos); $j++){

                if($numeros[$i] == $todos[$j]){
                    $cantidad++;
                }
            }
            $filtros[$i] = ['numero' => $numeros[$i], 'cantidad' => $cantidad];
        }

        return $filtros;       
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

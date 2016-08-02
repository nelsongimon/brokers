<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Estado;
use App\Ciudad;
use App\Sector;
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
        $banos = $this->cantidadFiltroInmueble('banos');
        $cuartos = $this->cantidadFiltroInmueble('cuartos');

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
        
        }

        //Carga de datos para los filtros
        $estados = Estado::all();
        $negos = Negociacion::all();
        $tipos = Tipo::all();
        $banos = $this->cantidadFiltroInmueble('banos');
        $cuartos = $this->cantidadFiltroInmueble('cuartos');

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
    public function cantidadFiltroInmueble($inmuebles,$atributo){

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
    *-----------------------------------------------------------------------------------
    *
    *
    **/
    public function cantidadFiltro($todos,$atributo){

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
            $filtros[$i] = [$atributo => $numeros[$i], 'cantidad' => $cantidad];
        }

        return $filtros;       
    }
    /*
    *
    *-----------------------------------------------------------------------------------
    *
    **/
    public function filtrado($filtrado){

        $palabra = str_replace("-en-", "/", $filtrado);
        $palabra = str_replace("-con-", "/", $palabra);
        $palabra = str_replace("-", " ", $palabra);
        $palabras = explode("/", $palabra);
        
        for($i = 0; $i < count($palabras); $i++){

            if(empty($tipo)){
                $tipo = Tipo::where('tipo','like','%'.$palabras[$i].'%')->first();
            }
            if(empty($negociacion)){
                $negociacion = Negociacion::where('negociacion','like','%'.$palabras[$i].'%')->first();
            }
            if(empty($estado)){
                $estado = Estado::where('estado','like','%'.$palabras[$i].'%')->first();
            }
            if(empty($ciudad)){
                $ciudad = Ciudad::where('ciudad','like','%'.$palabras[$i].'%')->first();
            }
            if(empty($sector)){
                $sector = Sector::where('sector','like','%'.$palabras[$i].'%')->first();
            }
            if(ends_with($palabras[$i],'banos') or ends_with($palabras[$i],'bano')){
                $pos = strpos($palabras[$i], ' ');
                $banos = substr($palabras[$i], 0, $pos);
            }
            if(ends_with($palabras[$i],'cuartos') or ends_with($palabras[$i],'cuarto')){
                $pos = strpos($palabras[$i], ' ');
                $cuartos = substr($palabras[$i], 0, $pos);
            }
        }


        $status = true;

        if(!empty($tipo->id)){
            $tipo_id = $tipo->id;
            $filtros[] = ['filtro' => 'tipo', 'valor' => $tipo->tipo];
            $status = false;
        }else{
            $tipo_id = null;
        }

        if(!empty($negociacion->id)){
            $negociacion_id = $negociacion->id;
            $filtros[] = ['filtro' => 'negociacion', 'valor' => $negociacion->negociacion];
            $status = false;
        }else{
            $negociacion_id = null;
        }

        if(!empty($estado->id)){
            $estado_id = $estado->id;
            $filtros[] = ['filtro' => 'estado', 'valor' => $estado->estado];
            $status = false;
        }else{
            $estado_id = null;
        }
        if(!empty($ciudad->id)){
            $ciudad_id = $ciudad->id;
            $filtros[] = ['filtro' => 'ciudad', 'valor' => $ciudad->ciudad];
            $status = false;
        }else{
            $ciudad_id = null;
        }
        if(!empty($sector->id)){
            $sector_id = $sector->id;
            $filtros[] = ['filtro' => 'sector', 'valor' => $sector->sector];
            $status = false;
        }else{
            $sector_id = null;
        }
        if(!empty($banos)){
            $banos = $banos;
            if($banos == 1){
                $filtros[] = ['filtro' => 'banos', 'valor' => $banos.' Baño'];
            }else{
                $filtros[] = ['filtro' => 'banos', 'valor' => $banos.' Baños'];
            }
            $status = false;
        }else{
            $banos = null;
        }
        if(!empty($cuartos)){
            $cuartos = $cuartos;
            if($cuartos == 1){
                $filtros[] = ['filtro' => 'cuartos', 'valor' => $cuartos.' Cuarto'];
            }
            else{
                $filtros[] = ['filtro' => 'cuartos', 'valor' => $cuartos.' Cuartos'];
            }
            $status = false;
        }else{
            $cuartos = null;
        }

        if($status){
            $filtros = false;
        }
     
        //Consulta para la busqueda Avanzada
        $results = DB::table('inmuebles')
            ->join('estados','inmuebles.estado_id','=','estados.id')
            ->join('ciudades','inmuebles.ciudad_id','=','ciudades.id')
            ->join('sectores','inmuebles.sector_id','=','sectores.id')
            ->join('tipos','inmuebles.tipo_id','=','tipos.id')
            ->join('negociaciones','inmuebles.negociacion_id','=','negociaciones.id')
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
            ->lists('inmuebles.id');

        //Ejecutar la consulta del modelo 
        if(!empty($results)){

            $inmuebles = Inmueble::find($results);

            foreach ($inmuebles as $inmueble) {
            
                $tipos[] = $inmueble->tipo->tipo;
                $negociaciones[] = $inmueble->negociacion->negociacion;
                $estados[] = $inmueble->estado->estado;
                $ciudades[] = $inmueble->ciudad->ciudad;
                $sectores[] = $inmueble->sector->sector;
            }

            //Carga de datos para los filtros
            $tipos = $this->cantidadFiltro($tipos,'tipo');
            $negociaciones = $this->cantidadFiltro($negociaciones,'negociacion');
            $estados = $this->cantidadFiltro($estados,'estado');
            $ciudades = $this->cantidadFiltro($ciudades,'ciudad');
            $sectores = $this->cantidadFiltro($sectores,'sector');
            $banos = $this->cantidadFiltroInmueble($inmuebles,'banos');
            $cuartos = $this->cantidadFiltroInmueble($inmuebles,'cuartos');
        }
        else{

            $inmuebles = false;
        
        }

        //dd($sectores);

        return view('front.resultados',[
            'inmuebles'     => $inmuebles,
            'cantidad'      => count($results),
            'estados'       => $estados,
            'ciudades'      => $ciudades,
            'sectores'      => $sectores,
            'negociaciones' => $negociaciones,
            'tipos'         => $tipos,
            'banos'         => $banos,
            'cuartos'       => $cuartos,
            'filtros'       => $filtros
            ]);
    
    }
    /*
    *
    *
    *-----------------------------------------------------------------------------------
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

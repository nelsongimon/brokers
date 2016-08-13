<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmpleoRequest;
use App\Http\Controllers\Controller;
use App\Inmueble;
use App\Estado;
use App\Ciudad;
use App\Sector;
use App\Negociacion;
use App\Tipo;
use App\Precio;
use App\Imagen;
use App\Asesor;
use App\Aspirante;
use App\Slider;
use App\Destacado;
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
        $sliders = Slider::all();
        $destacados = Destacado::all();
        return view('front.inicio',['sliders' => $sliders, 'destacados' => $destacados]);
    }
    /*
    *
    *
    *
    **/
    public function FormBusquedaAvanzada(){

        $estados = Estado::all();
        $tipos = Tipo::all();
        $negos = Negociacion::all();
        $min_precio = Precio::orderBy('dolares','asc')->limit(1)->lists('dolares');
        $max_precio = Precio::orderBy('dolares','desc')->limit(1)->lists('dolares');
        $destacados = Destacado::all();

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
            'max_star'   => $max_star,
            'destacados' => $destacados
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
    public function detallesInmuebles($id){

        $inmueble = Inmueble::find($id);
        
        //Verifica que el inmueble exista
        if(!$inmueble){
            abort(404);
        }

        return view('front.detallesInmuebles',['inmueble' => $inmueble]);
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

        
        //Ejecutar la consulta del modelo si existen resultados
        if(!empty($results)){

            $inmuebles = Inmueble::whereIn('id',$results)->orderBy('id','asc')->paginate(3);
            $pagination = true;
            foreach ($inmuebles as $inmueble) {
                foreach ($inmueble->imagenes as $imagen) {
                   if($imagen->principal == 'yes'){
                        $inmueble->imagenes = $imagen->imagen;
                   }
                }
            }

        }
        else{

            $inmuebles = false;
            $pagination = false;
        }

        //Cargar las cantidades de los filtros para la misma vista
        $propiedades = Inmueble::all();
        foreach ($propiedades as $propiedad) {
            
            $tipos[] = $propiedad->tipo->tipo;
            $negociaciones[] = $propiedad->negociacion->negociacion;
            $estados[] = $propiedad->estado->estado;
            $ciudades[] = $propiedad->ciudad->ciudad;
            $sectores[] = $propiedad->sector->sector;
        }


        $estados = $this->cantidadFiltro($estados,'estado');
        $ciudades = $this->cantidadFiltro($ciudades,'ciudad');
        $sectores = $this->cantidadFiltro($sectores,'sector');
        $tipos = $this->cantidadFiltro($tipos,'tipo');
        $negociaciones = $this->cantidadFiltro($negociaciones,'negociacion');
        $banos = $this->cantidadFiltroInmueble(Inmueble::all(),'banos');
        $cuartos = $this->cantidadFiltroInmueble(Inmueble::all(),'cuartos');
        $estacionamiento = $this->cantidadFiltroInmueble(Inmueble::all(),'estacionamientos');
        $filtros = false;

        return view('front.filtrado',[
            'inmuebles'       => $inmuebles,
            'cantidad'        => count($results),
            'estados'         => $estados,
            'ciudades'        => $ciudades,
            'sectores'        => $sectores,
            'negociaciones'   => $negociaciones,
            'tipos'           => $tipos,
            'banos'           => $banos,
            'cuartos'         => $cuartos,
            'estacionamiento' => $estacionamiento,
            'filtros'         => $filtros,
            'pagination'      => $pagination
            ]);

    }
    /*
    *
    *------------------------------------------------------------------------------
    *
    *
    **/
    public function busquedaAvanzada(Request $request){


        $estado_id = $request->estado;
        $ciudad_id = $request->ciudad;
        $sector_id = $request->sector;
        $tipo_id = $request->tipo;
        $negociacion_id = $request->negociacion;
        $cuartos = $request->cuartos;
        $banos = $request->banos;
        $estacionamientos = $request->estacionamiento;
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

            //Ejecutar consulta y agregar la paginacion
            $inmuebles = Inmueble::whereIn('id',$results)->orderBy('id','desc')->paginate(3);
            $pagination = true;
            foreach ($inmuebles as $inmueble) {
                foreach ($inmueble->imagenes as $imagen) {
                   if($imagen->principal == 'yes'){
                        $inmueble->imagenes = $imagen->imagen;
                   }
                }
            }

        }
        else{

            $inmuebles = false;
            $pagination = false;
        
        }


        //Cargar las cantidades de los filtros para la misma vista
        $propiedades = Inmueble::all();
        foreach ($propiedades as $propiedad) {
            
            $tipos[] = $propiedad->tipo->tipo;
            $negociaciones[] = $propiedad->negociacion->negociacion;
            $estados[] = $propiedad->estado->estado;
            $ciudades[] = $propiedad->ciudad->ciudad;
            $sectores[] = $propiedad->sector->sector;
        }


        $estados = $this->cantidadFiltro($estados,'estado');
        $ciudades = $this->cantidadFiltro($ciudades,'ciudad');
        $sectores = $this->cantidadFiltro($sectores,'sector');
        $tipos = $this->cantidadFiltro($tipos,'tipo');
        $negociaciones = $this->cantidadFiltro($negociaciones,'negociacion');
        $banos = $this->cantidadFiltroInmueble(Inmueble::all(),'banos');
        $cuartos = $this->cantidadFiltroInmueble(Inmueble::all(),'cuartos');
        $estacionamiento = $this->cantidadFiltroInmueble(Inmueble::all(),'estacionamientos');
        $filtros = false;

        return view('front.filtrado',[
            'inmuebles'       => $inmuebles,
            'cantidad'        => count($results),
            'estados'         => $estados,
            'ciudades'        => $ciudades,
            'sectores'        => $sectores,
            'negociaciones'   => $negociaciones,
            'tipos'           => $tipos,
            'banos'           => $banos,
            'cuartos'         => $cuartos,
            'estacionamiento' => $estacionamiento,
            'filtros'         => $filtros,
            'pagination'      => $pagination
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
        $palabra = str_replace("-para-", "/", $palabra);
        $palabra = str_replace("-orden-", "/", $palabra);
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
            if(ends_with($palabras[$i],'autos') or ends_with($palabras[$i],'auto')){
                $pos = strpos($palabras[$i], ' ');
                $estacionamiento = substr($palabras[$i], 0, $pos);
            }
            if(ends_with($palabras[$i],'menor') or ends_with($palabras[$i],'mayor') or ends_with($palabras[$i],'fecha')){
                
                $orden = $palabras[$i];
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
        if(!empty($estacionamiento)){
            $estacionamiento = $estacionamiento;
            if($estacionamiento == 1){
                $filtros[] = ['filtro' => 'estacionamiento', 'valor' => 'Para '.$estacionamiento.' auto'];
            }
            else{
                $filtros[] = ['filtro' => 'estacionamiento', 'valor' => 'Para '.$estacionamiento.' autos'];
            }
            $status = false;
        }else{
            $estacionamiento = null;
        }
        if(!empty($orden)){
            $orden = $orden;
            if($orden == 'menor'){
                $filtros[] = ['filtro' => 'orden', 'valor' => 'Menor precio'];
            }
            if($orden == 'mayor'){
                $filtros[] = ['filtro' => 'orden', 'valor' => 'Mayor precio'];
            }
            if($orden == 'fecha'){
                $filtros[] = ['filtro' => 'orden', 'valor' => 'Más recientes'];
            }
            $status = false;
        }else{
            $orden = null;
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
            ->where(function($query) use ($estacionamiento){
                if(!empty($estacionamiento)){
                    $query->where('inmuebles.estacionamientos','=',$estacionamiento);
                }
            })
            ->lists('inmuebles.id');

      

        //Ejecutar la consulta del modelo 
        if(!empty($results)){
            //Ejecutar la consulta completa
            $inmuebles = Inmueble::find($results);
            $pagination = true;

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
            $estacionamiento = $this->cantidadFiltroInmueble($inmuebles,'estacionamientos');
            
            //Agregar la paginacion a la consulta
            if(!empty($orden)){
                switch ($orden) {
                    case 'fecha':
                        $inmuebles = Inmueble::whereIn('id',$results)->orderBy('created_at','desc')->paginate(3);
                    break;
                }
            }
            else{

                $inmuebles = Inmueble::whereIn('id',$results)->orderBy('id','asc')->paginate(3);
            }
            
            foreach ($inmuebles as $inmueble) {
                foreach ($inmueble->imagenes as $imagen) {
                   if($imagen->principal == 'yes'){
                        $inmueble->imagenes = $imagen->imagen;
                   }
                }
            }

        }
        else{

            $inmuebles = false;
            $pagination = false;
        
        }

        return view('front.filtrado',[
            'inmuebles'       => $inmuebles,
            'cantidad'        => count($results),
            'estados'         => $estados,
            'ciudades'        => $ciudades,
            'sectores'        => $sectores,
            'negociaciones'   => $negociaciones,
            'tipos'           => $tipos,
            'banos'           => $banos,
            'cuartos'         => $cuartos,
            'estacionamiento' => $estacionamiento,
            'filtros'         => $filtros,
            'pagination'      => $pagination
            ]);
    
    }
    /*
    *
    *
    *-----------------------------------------------------------------------------------
    *
    **/
    public function showAsesores(){

        $asesores = Asesor::all();
        $destacados = Destacado::all();
        return view('front.asesores',['asesores' => $asesores, 'destacados' => $destacados]);
    }
    /*
    *
    *
    *
    */
    public function empleo(){

        $destacados = Destacado::all();
        return view('front.empleo',['destacados' => $destacados]);
    }
    /*
    *
    *
    *
    *
    **/
    public function formEmpleo(EmpleoRequest $request){

        $file = $request->file('curriculum');
        $file_name = time().'_'.$file->getClientOriginalname();
        $path = public_path().'/archivos';
        $archivo = explode('.', $file_name);
        $extension = end($archivo);
        
        $file->move($path,$file_name);

        $aspirante = Aspirante::create($request->all());
        $aspirante->curriculum = $file_name;
        $aspirante->extension = $extension;
        $aspirante->save();

        Session::flash('mensaje-success','La información se ha enviado con éxito');
        return redirect('/empleo');
    }
    /*
    *
    *
    *
    */
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

  
}

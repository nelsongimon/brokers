@extends('layouts.front')

@section('title','Brokers Bienes y Raices')

@section('css')

<!-- Formulario Rango-->
<link rel="stylesheet" href="{{ asset('front/assets/noUiSlider/nouislider.css') }}"/>

<!-- Owl stylesheet -->
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.theme.css') }}">


@endsection


@section('content')

<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        <h2>Asesores Inmobiliarios</h2>
    </div>
  </div>


<!-- ------------------------- Asesores -------------------------- -->

<div class="container">
  <div class="spacer agents">
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10 col-md-offset-1 col-md-10">
        @foreach ($asesores as $asesor)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <div class="contenedor-asesor">
            <div class="imagen-asesor">
              <img src="{{ asset('/images/asesores').'/'.$asesor->foto }}" class="img-responsive"  alt="agent name">
              <div class="marca-brokers"><img src="{{ asset('front/images/brokers_marca.png') }}" class="logo-marca"></div>
              <div class="contenedor-asesor-nombre">
                {{ $asesor->nombre.' '.$asesor->apellido }}
              </div>
            </div>
            <div class="contenedor-asesor-info">
                <div class="info-asesor"><span class="glyphicon glyphicon-envelope"></span>&nbsp; {{ $asesor->apellido }}</div>
                <div class="info-asesor"><span class="fa fa-phone"></span>&nbsp;&nbsp; {{ $asesor->telefono }}</div>
            </div> 
          </div>
        </div>      
        @endforeach
      </div>
    </div>
  </div>
</div>
<!-- ********************************* -->
<div class="container">
  <div class="linea"></div>
</div>


<!-- ----------------------Propiedades Destacadas-------------------------- -->
<div class="container">
  <div class="properties-listing spacer"> 
    
    <div class="destacadas">Propiedades destacadas</div>

    <div id="owl-example" class="owl-carousel">
        
        @foreach ($destacados as $destacado)
          
      <div class="properties properties-destacados">
          <a href="{{ url('propiedades').'/'.$destacado->inmueble->id.'/'.$destacado->inmueble->slug }}">
          <div class="image-holder"><img src="{{ asset('images/inmuebles').'/Thumb_'.$destacado->imagen }}" class="img-responsive"  alt="properties"/>
              <div class="precio-carousel">$ {{ number_format($destacado->inmueble->precio->dolares,0,'.',',') }}</div>
              <div class="negociacion-carousel">{{ $destacado->inmueble->negociacion->negociacion }}</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span>
                <i class="fa fa-bed"></i> {{ $destacado->inmueble->cuartos }} 
                  @if($destacado->inmueble->cuartos == 1)
                    Cuarto 
                  @else
                    Cuartos
                  @endif
              </span>
              <span><i class="fa fa-tint"></i> </i> {{ $destacado->inmueble->cuartos }} 
                  @if($destacado->inmueble->banos == 1)
                    Baño 
                  @else
                    Baños
                  @endif 
              </span> 
              <span><i class="fa fa-expand"></i> {{ $destacado->inmueble->area_parcela }}m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="{{ url('propiedades').'/'.$destacado->inmueble->id.'/'.$destacado->inmueble->slug }}">{{ str_limit($destacado->titulo,26) }}</a>
              </div>
              <div class="tipo">
                  {{ $destacado->inmueble->tipo->tipo }}
              </div>
          </div>  
      </div>

        @endforeach

 
    </div>
  </div>
</div>

@endsection


@section('javascript')

  <!-- Owl stylesheet -->
  <script src="{{ asset('front/assets/owl-carousel/owl.carousel.js') }}"></script>

@endsection
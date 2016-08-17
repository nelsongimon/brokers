@extends('layouts.front')

@section('title','Brokers Bienes y Raices')

@section('css')

<!-- Owl stylesheet -->
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.theme.css') }}">

  


@endsection


@section('content')

<!-- ---------------------- banner -------------------------- -->

  <div class="inside-banner">
    <div class="container"> 
        <h2>Pasos para vender</h2>
    </div>
  </div>


<!-- ----------------- Pasos para vender -------------------------- -->


<section class="pasos-vender">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-offset-1 col-md-9">
        <ul class="lista-pasos" style="padding-left: 0px;">
          <li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Asesorarse con un corredor inmobiliario</li>
          <li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Análisis del mercado</li>
          <li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Estimar precio del inmueble</li>
          <li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Comercializar y promocionar el inmueble</li>
          <li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Documentos para poder vender:
            <ul>
              <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Documento de propiedad</li>
              <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Solvencia municipal</li>
              <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Ficha catastral</li>
              <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Declaración de vivienda principal</li>
              <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Pago planilla forma 20 </li>
              <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Liberación registrada en caso de haber tenido una hipoteca</li>
            </ul>
          </li>
          <li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Solvencia de los servicios públicos y condominio</li>
        </ul>
      </div>
    </div>
  </div>
</section>


<!-- ---------------------- Propiedades Destacadas ----------------------- -->
<div class="container">
  <div class="properties-listing spacer"> 
    
    <div class="destacadas">Propiedades destacadas <span>&nbsp;<a href="{{ url('/propiedades') }}" class="ver-todas">Ver todas</a></span></div>

    <div id="owl-example" class="owl-carousel">
        
      @foreach ($destacados as $destacado)
      @if($destacado->inmueble->status == 'yes')     
      <div class="properties properties-destacados">
          <a href="{{ url('propiedades').'/'.$destacado->inmueble->id.'/'.$destacado->inmueble->slug }}">
          <div class="image-holder"><img src="{{ asset('images/inmuebles').'/Thumb_'.$destacado->imagen }}" class="img-responsive"  alt="properties"/>
              <div class="precio-carousel">Bs {{ number_format($destacado->inmueble->bolivares,0,',','.') }}</div>
              <div class="negociacion-carousel">{{ $destacado->inmueble->negociacion->negociacion }}</div>
          </div>
          </a>
          <div class="detalles-carousel">
              @if($destacado->inmueble->cuartos > 0)
              <span>
                <i class="fa fa-bed"></i> {{ $destacado->inmueble->cuartos }} 
                  @if($destacado->inmueble->cuartos == 1)
                    Cuarto 
                  @else
                    Cuartos
                  @endif
              </span>
              @endif
              @if($destacado->inmueble->banos > 0)
              <span><i class="fa fa-tint"></i> </i> {{ $destacado->inmueble->banos }} 
                  @if($destacado->inmueble->banos == 1)
                    Baño 
                  @else
                    Baños
                  @endif 
              </span>
              @endif 
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
      @endif
      @endforeach

 
    </div>
  </div>
</div>
@endsection


@section('javascript')

  <!-- Owl stylesheet -->
  <script src="{{ asset('front/assets/owl-carousel/owl.carousel.js') }}"></script>


@endsection
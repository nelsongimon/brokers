@extends('layouts.front')

@section('title','Brokers Bienes Raíces')

@section('css')

<!-- Owl stylesheet -->
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.theme.css') }}">

  


@endsection


@section('content')

<!-- ---------------------- banner -------------------------- -->

  <div class="inside-banner">
    <div class="container"> 
        <h2>Tips para un vendedor</h2>
    </div>
  </div>


<!-- ---------------------- Tips para un vendedor -------------------------- -->


  <section class="tips-vendedor">
    <div class="container">
  
      <div class="row">
      
        <div class="col-xs-12 col-md-offset-1 col-md-5">
          <h2 class="vendedor-titulo"><i class="fa fa-check-circle" style="color:#72b70f;" aria-hidden="true"></i>&nbsp; Decisión</h2>
          <p class="vendedor-texto">Todos los involucrados en el inmueble estén de acuerdo en la venta del inmueble</p>
        </div>
        <div class="col-xs-12 col-md-5">
          <h2 class="vendedor-titulo"><i class="fa fa-check-circle" style="color:#72b70f;" aria-hidden="true"></i>&nbsp; Dinero</h2>
          <p class="vendedor-texto">Uso que le darán al capital recibido por la venta del inmueble</p>
        </div>
        <div class="col-xs-12 col-md-offset-1 col-md-5">
          <h2 class="vendedor-titulo"><i class="fa fa-check-circle" style="color:#72b70f;" aria-hidden="true"></i>&nbsp; Deseo</h2>
          <p class="vendedor-texto">Todos los involucrados en el inmueble quieren vender dicho inmueble para cambiarlo por uno mejor o hacer una mejor inversión</p>
        </div>
        <div class="col-xs-12 col-md-5">
          <h2 class="vendedor-titulo"><i class="fa fa-check-circle" style="color:#72b70f;" aria-hidden="true"></i>&nbsp; Precio del inmueble</h2>
          <p class="vendedor-texto">Ajustarse al precio del mercado para poder tener una venta efectiva</p>
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
          <div class="image-holder"><img src="{{ asset('images/inmuebles').'/'.$destacado->imagen }}" class="img-responsive"  alt="properties"/>
              <div class="precio-carousel">Bs {{ number_format($destacado->inmueble->bolivares,0,',','.') }}</div>
              <div class="negociacion-carousel">{{ $destacado->inmueble->negociacion->negociacion }}</div>
          </div>
          </a>
          <div class="detalles-carousel">
              @if(!empty($destacado->inmueble->cuartos))
              <span>
                <i class="fa fa-bed"></i> {{ $destacado->inmueble->cuartos }} 
                  @if($destacado->inmueble->cuartos == 1)
                    Hab.
                  @else
                    Hab.
                  @endif
              </span>
              @endif
              @if(!empty($destacado->inmueble->banos))
              <span><i class="fa fa-tint"></i> </i> {{ $destacado->inmueble->banos }} 
                  @if($destacado->inmueble->banos == 1)
                    Baño 
                  @else
                    Baños
                  @endif 
              </span>
              @endif 
              <span><i class="fa fa-expand"></i> {{ $destacado->inmueble->area_construccion }}m² </span>    
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
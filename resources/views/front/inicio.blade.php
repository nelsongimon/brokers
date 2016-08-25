@extends('layouts.front')

@section('title','Brokers Bienes y Raices')

@section('css')

<!-- slitslider -->
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/slitslider/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/slitslider/css/custom.css') }}" />


<!-- Owl stylesheet -->
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.theme.css') }}">


<style type="text/css">

  @foreach ($sliders as $slider)
  @if($slider->inmueble->status == 'yes')  
    .bg-img-{{ str_slug($slider->titulo,'-') }} {
      background-image: url({{ asset('images/inmuebles').'/'.$slider->imagen }});
    }
  @endif
  @endforeach

</style>
@endsection


@section('content')


<!-- -----------------------Slider-------------------------- -->
<div class="container-fluid">
  <div id="loader" style="text-align: center;"></div>
  <div id="slider" class="sl-slider-wrapper" style="visibility: hidden;">
      <div class="sl-slider">
        @foreach ($sliders as $slider)
        @if($slider->inmueble->status == 'yes') 
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img" style="background-image: url({{ asset('images/inmuebles').'/'.$slider->imagen }})"></div>
              <h2><a href="{{ url('propiedades').'/'.$slider->inmueble->id.'/'.$slider->inmueble->slug }}">{{ str_limit($slider->inmueble->titulo,45) }}</a></h2>
              <blockquote>              
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> {{ $slider->inmueble->sector->sector.', '.$slider->inmueble->ciudad->ciudad.'. Estado '.$slider->inmueble->estado->estado}}</p>
              @if($slider->inmueble->banos > 0)
              <p style="font-size: 25px">
                {{ $slider->inmueble->banos }}
                @if($slider->inmueble->banos == 1)
                    Baño
                @else
                    Baños
                @endif
              </p>
              @endif
              @if($slider->inmueble->cuartos > 0)
              <p style="font-size: 25px">
                {{ $slider->inmueble->cuartos }}
                @if($slider->inmueble->cuartos == 1)
                    Cuarto
                @else
                    Cuartos
                @endif
              </p>
              @endif
              <p class="precio">Bs {{ number_format($slider->inmueble->bolivares,0,',','.') }}</p>
              </blockquote>
            </div>
          </div>
        @endif
        @endforeach
          
      </div><!-- /sl-slider -->

      <nav id="nav-dots" class="nav-dots">
        @foreach ($sliders as $slider) 
        @if($slider->inmueble->status == 'yes') 
          <span></span>
        @endif
        @endforeach
      </nav>

  </div><!-- /slider-wrapper -->
</div>
<!-- ----------------------Busqueda Rapida-------------------------- -->
<div class="banner-search">
  <div class="container"> 
    <!-- banner -->
    <div class="row">
      <div class="col-lg-offset-1 col-lg-11">
        <h3>Busca tu mejor opción</h3>
      </div>
    </div>
    <div class="searchbar">
      <div class="row">
        <div class="col-lg-offset-1 col-lg-6">
          {!! Form::open(['route'=>'front.busquedaRapida', 'method'=>'get']) !!}
           <div class="input-group">  
              <input type="text" class="form-control input-lg" name="busqueda" placeholder="Ingresa el sector, ciudad, estado o el tipo de inmueble">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-lg" type="button">Buscar</button>
              </span>
            </div><!-- /input-group -->
          {!! Form::close() !!}
        </div>
        <div class="col-lg-4">
          <p class="texto-home">Encuentre las mejores propiedades de Venezuela en un solo lugar</p>       
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ----------------------Propiedades Destacadas-------------------------- -->
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
<!-- ---------------------Pasos para vender----------------------- -->

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-3">
      <a href="{{ url('/pasos-para-vender') }}"><img src="{{ asset('front/images/pasosvender.png') }}" class="img-rounded" width="100%"></a>
    </div>
  </div>
</div>


@endsection


@section('javascript')

    <script src="{{ asset('front/assets/funciones.js') }}"></script>

	<!-- slitslider -->
    <script type="text/javascript" src="{{ asset('front/assets/slitslider/js/modernizr.custom.79639.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/assets/slitslider/js/jquery.ba-cond.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/assets/slitslider/js/jquery.slitslider.js') }}"></script>

	<!-- Owl stylesheet -->
	<script src="{{ asset('front/assets/owl-carousel/owl.carousel.js') }}"></script>

@endsection
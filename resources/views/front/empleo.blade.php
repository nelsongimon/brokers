@extends('layouts.front')

@section('title','Brokers Bienes Raíces')

@section('css')

<!-- Formulario Rango-->
<link rel="stylesheet" href="{{ asset('front/assets/noUiSlider/nouislider.css') }}"/>

<!-- Owl stylesheet -->
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owl-carousel/owl.theme.css') }}">

<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">


@endsection


@section('content')

<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        <h2>Solicitud de Empleo</h2>
    </div>
  </div>


<!-- ----------------- Formulario solicitud empleo -------------------------- -->

<section class="fondo-empleo">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-xs-12">
          <div class="hidden-xs">
            <p class="texto-empleo">En Brokers Bienes Raíces estamos en la búsqueda de personas con habilidades profesionales en el ramo inmobiliario o que quieran comenzar una carrera con nosotros. Si eres una persona proactiva, emprendedora y con deseos de superación, completa el siguiente formulario y únete a nuestra gran familia.</p>
          </div>
          {!! Form::open(['route' => 'front.empleo', 'method' => 'post', 'files' => 'true']) !!}
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="titulo-empleo">Nombre</label>
                <input type="text" class="form-control input-empleo" id="" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre">
              </div> 
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="titulo-empleo">Email</label>
                <input type="text" class="form-control input-empleo" id="" name="email" value="{{ old('email') }}" placeholder="Email">
              </div> 
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="titulo-empleo">Teléfono</label>
                <input type="text" class="form-control input-empleo" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono">
              </div> 
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="titulo-empleo">Curriculum</label>
                <input type="file" class="form-control input-empleo" id="" name="curriculum">
              </div> 
            </div>
            <div class="col-md-6 col-xs-12">
              <button type="submit" class="btn btn-primary input-empleo-button">Enviar</button>
            </div>
          {!! Form::close() !!}
    </div>
  </div>
</section


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

  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/input-mask/jquery.inputmask.phone.extensions.js') }}"></script>

  <script type="text/javascript">
    
    $('#telefono').inputmask({"mask": "(9999) 999-9999"});
    
  </script>

  @include('alerts.mensajes')

@endsection
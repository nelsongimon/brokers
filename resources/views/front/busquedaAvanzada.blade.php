@extends('layouts.front')

@section('title','Brokers Bienes Raíces')

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
        <h2>Búsqueda Avanzada</h2>
    </div>
  </div>


<!-- ---------------------- Busqueda Avanzada -------------------------- -->

<section class="fondo-busqueda">
<div class="separador3"></div>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-offset-1 col-lg-10">
    <div class="panel panel-default opacity-panel">
      <div class="panel-body">
        {!! Form::open(['route' => 'front.busquedaAvanzada', 'method' => 'get']) !!}
            <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Estado</label>
                  <select class="form-control input-busqueda-avanzada" id="select-estado" name="estado">
                    <option value="">--Todos--</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                    @endforeach
                      <input type="hidden" id="token-estado" value="{{ csrf_token() }}"/>
                      <input type="hidden" id="url-estado" value="{{ route('front.estadosCiudades') }} "/>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Ciudad</label>
                  <select class="form-control input-busqueda-avanzada" id="select-ciudad" name="ciudad">
                    <option value="">--Todos--</option>
                  </select>
                  <input type="hidden" id="token-ciudad" value="{{ csrf_token() }}"/>
                  <input type="hidden" id="url-ciudad" value="{{ route('front.ciudadesSectores') }} "/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda" >Sector</label>
                  <select class="form-control input-busqueda-avanzada" id="select-sector" name="sector">
                    <option value="">--Todos--</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Tipo de inmueble</label>
                  <select class="form-control input-busqueda-avanzada" id="" name="tipo">
                    <option value="">--Todos--</option>
                    
                    @foreach ($tipos as $tipo)
                      <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Tipo de negociación</label>
                  <select class="form-control input-busqueda-avanzada" id="" name="negociacion">
                    <option value="">--Todos--</option>
                    @foreach ($negos as $nego)
                      <option value="{{ $nego->id }}">{{ $nego->negociacion }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Min. Habitaciones</label>
                  <input type="number" min="0" max="100" class="form-control input-busqueda-avanzada" name="cuartos" id="" placeholder="Min. Habitaciones"/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Min. Baños</label>
                  <input type="number" min="0" max="100" class="form-control input-busqueda-avanzada" name="banos" id="" placeholder=" Min. Baños"/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Min. Estacionamiento</label>
                  <input type="number" min="0" max="100" class="form-control input-busqueda-avanzada" name="estacionamiento" id="" placeholder="Min. Estacionamientos"/>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <div class="cantidad-range">Precio: <span id="slider-margin-value-min"></span> Bs a <span id="slider-margin-value-max"></span> Bs</div>
                  <div id="slider-margin" name="slider-margin"></div>
                </div>
                <input type="hidden" name="minimo" id="precio-minimo"/>
                <input type="hidden" name="maximo" id="precio-maximo"/>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary input-busqueda-button">Buscar</button>
                </div>
              </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>  
  </div>
</div>
</section>


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
              <span><i class="fa fa-tint"></i> {{ $destacado->inmueble->banos }} 
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

  <!-- Formulario Rango-->
  <script src="{{ asset('front/assets/noUiSlider/nouislider.min.js') }}"></script>
  <script src="{{ asset('front/assets/noUiSlider/wNumb.js') }}"></script>

	<!-- Owl stylesheet -->
	<script src="{{ asset('front/assets/owl-carousel/owl.carousel.js') }}"></script>


  <script type="text/javascript">

      //Configuracion del rango
      var marginSlider = document.getElementById('slider-margin');

      noUiSlider.create(marginSlider, {
        start: [ {{ $min_start }}, {{ $max_start }} ],
        connect:true,
        step: 1000,
        range: {
          'min': {{ $min_precio }},
          'max': {{ $max_precio }}
        },
        format: wNumb({
          decimals: 3,
          thousand: '.'
        })
      });

      var marginMin = document.getElementById('slider-margin-value-min'),
      marginMax = document.getElementById('slider-margin-value-max');

      marginSlider.noUiSlider.on('update', function ( values, handle ) {
        if ( handle ) {
          marginMax.innerHTML = values[handle];
          $('#precio-maximo').val(values[handle]);
        } else {
          marginMin.innerHTML = values[handle];
          $('#precio-minimo').val(values[handle]);
        }
      });

  </script>

  <script src="{{ asset('front/assets/funciones.js') }}"></script>

@endsection
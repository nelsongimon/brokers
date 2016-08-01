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
        {!! Form::open(['route' => 'front.busqueda', 'method' => 'post']) !!}
            <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Estado</label>
                  <select class="form-control input-busqueda-avanzada" id="select-estado" name="estado_id">
                    <option value="">--Todos--</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                    @endforeach
                      <input type="hidden" id="token-estado" value="{{ csrf_token() }}"/>
                      <input type="hidden" id="url-estado" value="{{ route('admin.localizacion.sectores.estadosCiudades') }} "/>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Ciudad</label>
                  <select class="form-control input-busqueda-avanzada" id="select-ciudad" name="ciudad_id">
                    <option value="">--Todos--</option>
                  </select>
                  <input type="hidden" id="token-ciudad" value="{{ csrf_token() }}"/>
                  <input type="hidden" id="url-ciudad" value="{{ route('admin.localizacion.sectores.ciudadesSectores') }} "/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda" >Sector</label>
                  <select class="form-control input-busqueda-avanzada" id="select-sector" name="sector_id">
                    <option value="">--Todos--</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="label-busqueda">Tipo de inmueble</label>
                  <select class="form-control input-busqueda-avanzada" id="" name="tipo_id">
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
                  <select class="form-control input-busqueda-avanzada" id="" name="negociacion_id">
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
                  <label class="label-busqueda">Min. Estacionamientos</label>
                  <input type="number" min="0" max="100" class="form-control input-busqueda-avanzada" name="estacionamientos" id="" placeholder="Min. Estacionamientos"/>
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
    
    <div class="destacadas">Propiedades destacadas</div>

    <div id="owl-example" class="owl-carousel">
    
        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Venta</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div>


        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Venta</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div>

        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/1.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Venta</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div>

        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Alquiler</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div>


        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/1.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Venta</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div>

        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/4.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Venta</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div>

        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/3.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Alquiler</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Casa
              </div>
            </div>  
        </div>
        <div class="properties properties-resultados">
          <a href="#">
          <div class="image-holder"><img src="{{ asset('front/images/properties/1.jpg') }}" class="img-responsive" alt="properties"/>
              <div class="precio-carousel">Bs 100.000.000</div>
              <div class="negociacion-carousel">Venta</div>
          </div>
          </a>
          <div class="detalles-carousel">
              <span><i class="fa fa-bed"></i> 2 Cuartos </span>
              <span><i class="fa fa-tint"></i> 2 Baños </span> 
              <span><i class="fa fa-expand"></i> 41m² </span>    
          </div>
          <div class="titulo-tipo-carousel">
              <div class="titulo">
                  <a href="#">Bella casa en Tipuro con vista...</a>
              </div>
              <div class="tipo">
                  Apartamento
              </div>
            </div>  
        </div> 
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
        start: [ {{ $min_star }}, {{ $max_star }} ],
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
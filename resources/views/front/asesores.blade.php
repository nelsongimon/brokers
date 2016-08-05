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

  <!-- Owl stylesheet -->
  <script src="{{ asset('front/assets/owl-carousel/owl.carousel.js') }}"></script>

@endsection
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
  .bg-img-1 {
    background-image: url({{ asset('front/images/slider/1.jpg') }});
  }
   .bg-img-2 {
    background-image: url({{ asset('front/images/slider/2.jpg') }});
  }
   .bg-img-3 {
    background-image: url({{ asset('front/images/slider/3.jpg') }});
  }
   .bg-img-4 {
    background-image: url({{ asset('front/images/slider/4.jpg') }});
  }
   .bg-img-5 {
    background-image: url({{ asset('front/images/slider/5.jpg') }});
  }
</style>
@endsection


@section('content')


<!-- -----------------------Slider-------------------------- -->
<div class="container-fluid">
        <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">

          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-1"></div>
              <h2><a href="#">Título de la vivienda</a></h2>
              <blockquote>              
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Dirección</p>
              <p>Área de parcela</p>
              <p>Área de construcción</p>
              <p class="location">Precio</p>
              </blockquote>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="1.5" data-slice2-scale="1.5">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-2"></div>
              <h2><a href="#">Título de la vivienda</a></h2>
              <blockquote>              
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Dirección</p>
              <p>Área de parcela</p>
              <p>Área de construcción</p>
              <p class="location">Precio</p>
              </blockquote>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-3"></div>
              <h2><a href="#">Título de la vivienda</a></h2>
              <blockquote>              
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Dirección</p>
              <p>Área de parcela</p>
              <p>Área de construcción</p>
              <p class="location">Precio</p>
              </blockquote>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-4"></div>
              <h2><a href="#">Título de la vivienda</a></h2>
              <blockquote>              
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Dirección</p>
              <p>Área de parcela</p>
              <p>Área de construcción</p>
              <p class="location">Precio</p>
              </blockquote>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-5"></div>
              <h2><a href="#">Título de la vivienda</a></h2>
              <blockquote>              
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Dirección</p>
              <p>Área de parcela</p>
              <p>Área de construcción</p>
              <p class="location">Precio</p>
              </blockquote>
            </div>
          </div>
        </div><!-- /sl-slider -->

        <nav id="nav-dots" class="nav-dots">
          <span class="nav-dot-current"></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
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
          {!! Form::open(['route'=>'front.busquedaRapida', 'method'=>'PUT']) !!}
           <div class="input-group">  
              <input type="text" class="form-control input-lg" name="busqueda" placeholder="Ingresa Sector, Ciudad, Estado o el tipo de inmueble">
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

	<!-- slitslider -->
    <script type="text/javascript" src="{{ asset('front/assets/slitslider/js/modernizr.custom.79639.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/assets/slitslider/js/jquery.ba-cond.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/assets/slitslider/js/jquery.slitslider.js') }}"></script>

	<!-- Owl stylesheet -->
	<script src="{{ asset('front/assets/owl-carousel/owl.carousel.js') }}"></script>

@endsection
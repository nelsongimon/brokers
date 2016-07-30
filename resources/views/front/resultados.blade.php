@extends('layouts.front')

@section('title','Brokers Bienes y Raices')

@section('css')


@endsection


@section('content')


<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        <h2>Resultados</h2>
    </div>
  </div>

<!-- -------------------- Resultados ------------------------ -->
<div class="separador2"></div>
<div class="container">
  <div class="row">
      <!-- -------------------- Filtros ------------------------ -->
      <div class="hidden-xs hidden-sm col-md-2 col-filter-content">
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-aplicados">
              Filtros Aplicados
            </div>
            <ul class="list-filter">
              <li><a href="#"><span class="glyphicon glyphicon-remove"></a> Bolivar</span></li>
              <li><a href="#"><span class="glyphicon glyphicon-remove"></a> Venta</span></li>
              <li><a href="#"><span class="glyphicon glyphicon-remove"></a> Apartamento</span></li>
              <li><a href="#"><span class="glyphicon glyphicon-remove"></a> Puerto Ordaz</span></li>
            </ul>
          </div>
        </div>  
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <span class="glyphicon glyphicon-map-marker"><span class="font-filter"> Estado</span></span>
            </div>
              <ul class="list-filter">
                <li><a href="#">Bolivar</a> <span class="cantidad-filter">(5)</span></li>
                <li><a href="#">Carabobo</a> <span class="cantidad-filter">(12)</span></li>
                <li><a href="#">Monagas</a> <span class="cantidad-filter">(25)</span></li>
                <li><a href="#">Anzoategui</a> <span class="cantidad-filter">(3)</span></li>
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-money" aria-hidden="true"></i><span class="font-filter"> Negociación</span></span>
            </div>
              <ul class="list-filter">
                <li><a href="#">Venta</a> <span class="cantidad-filter">(5)</span></li>
                <li><a href="#">Alquiler</a> <span class="cantidad-filter">(12)</span></li>
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-home" aria-hidden="true"></i><span class="font-filter"> Tipo de inmueble</span></span>
            </div>
              <ul class="list-filter">
                <li><a href="#">Casa</a> <span class="cantidad-filter">(5)</span></li>
                <li><a href="#">Apartamento</a> <span class="cantidad-filter">(12)</span></li>
                <li><a href="#">Oficina</a> <span class="cantidad-filter">(25)</span></li>
                <li><a href="#">Habitación</a> <span class="cantidad-filter">(3)</span></li>
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa fa-bed" aria-hidden="true"></i><span class="font-filter"> Cuartos</span></span>
            </div>
              <ul class="list-filter">
                <li><a href="#">1 Cuarto</a> <span class="cantidad-filter">(5)</span></li>
                <li><a href="#">2 Cuartos</a> <span class="cantidad-filter">(12)</span></li>
                <li><a href="#">3 Cuartos</a> <span class="cantidad-filter">(25)</span></li>
                <li><a href="#">4 Cuartos</a> <span class="cantidad-filter">(3)</span></li>
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-tint" aria-hidden="true"></i><span class="font-filter"> Baños</span></span>
            </div>
              <ul class="list-filter">
                <li><a href="#">1 Baño</a> <span class="cantidad-filter">(5)</span></li>
                <li><a href="#">2 Baños</a> <span class="cantidad-filter">(12)</span></li>
                <li><a href="#">3 Baños</a> <span class="cantidad-filter">(25)</span></li>
                <li><a href="#">4 Baños</a> <span class="cantidad-filter">(3)</span></li>
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <span class="font-filter">Ordenado Por</span></span>
            </div>
              <ul class="list-filter">
                <li><a href="#">Mayor Precio</a></li>
                <li><a href="#">Menor Precio</a></li>
                <li><a href="#">Fecha dePublicación</a></li>
              </ul>
          </div>
        </div>

      </div>


      <!-- -------------------- Inmuebles ------------------------ -->
      <div class="col-xs-12 col-sm-12 col-md-10">
        <div class="properties-listing spacer"> 
          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Venta</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Alquiler</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Venta</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Venta</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Venta</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Venta</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Alquiler</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Venta</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
                  <div class="titulo">
                    <a href="#">Bella casa en Tipuro con vista...</a>
                  </div>
                  <div class="tipo">
                    Apartamento
                  </div>
                </div>
               
              </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="properties properties-resultados">
                <a href="">
                <div class="image-holder"><img src="{{ asset('front/images/properties/2.jpg') }}" class="img-responsive" alt="properties"/>
                  <div class="precio-resultados">Bs 100.000.000</div>
                  <div class="negociacion-resultados">Alquiler</div>
                </div>
                </a>
                 <div class="detalles-resultados">
                     <span><i class="fa fa-bed"></i> 2 Cuartos </span>
                     <span><i class="fa fa-tint"></i> 2 Baños </span> 
                     <span><i class="fa fa-expand"></i> 41m² </span>    
                 </div>
                <div class="titulo-tipo-resultados">
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
  </div>


  <div class="row">
    <div class="col-xs-12" style="text-align: center">
        <ul class="pagination pagination-primary">
          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
  </div>
</div>

@endsection


@section('javascript')



@endsection
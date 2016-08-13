@extends('layouts.front')

@section('title','Inmuebles en Venezuela')

@section('css')


@endsection


@section('content')


<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        @if($cantidad == 1)
        <h2>Se encontro {{ $cantidad }} propiedad </h2>
        @else
        <h2>Se encontraron {{ $cantidad }} propiedades </h2>
        @endif
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
            <div class="box-filtrar-aplicados" style="padding: 5px 14px;">
              Filtros 
            </div>            
          </div>
        </div>  
        <div class="col-xs-12 col-filter-item" id="seleccion-estados">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <span class="glyphicon glyphicon-map-marker"><span class="font-filter"> Estado</span></span>
            </div>
              <ul class="list-filter">

                @foreach ($estados as $estado)
                  @if(count($estado->inmuebles) != 0)
                  <li><a href="javascript:void(0)" id="state" data-state="{{ str_slug($estado->estado,"-") }}"  onclick="addFilter('{{ str_slug($estado->estado,"-") }}','estado')">{{ $estado->estado }}</a> <span class="cantidad-filter">({{ count($estado->inmuebles) }})</span></li>
                  @else

                  @endif
                @endforeach

              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item" id="seleccion-negociaciones">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-money" aria-hidden="true"></i><span class="font-filter"> Negociación</span></span>
            </div>
              <ul class="list-filter">
                @foreach ($negociaciones as $negociacion)
                  @if(count($negociacion->inmuebles) != 0)
                  <li><a href="javascript:void(0)" onclick="addFilter('{{ str_slug($negociacion->negociacion,"-") }}','negociacion')">{{ $negociacion->negociacion }}</a> <span class="cantidad-filter">({{ count($negociacion->inmuebles) }})</span></li>
                  @else

                  @endif
                @endforeach

              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item" id="seleccion-tipos">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-home" aria-hidden="true"></i><span class="font-filter"> Tipo de inmueble</span></span>
            </div>
              <ul class="list-filter">

                @foreach ($tipos as $tipo)
                  @if(count($tipo->inmuebles) != 0)
                  <li><a href="javascript:void(0)"  onclick="addFilter('{{ str_slug($tipo->tipo,"-") }}','tipo')">{{ $tipo->tipo }}</a> <span class="cantidad-filter">({{ count($tipo->inmuebles) }})</span></li>
                  @else

                  @endif
                @endforeach


              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item" id="seleccion-cuartos">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa fa-bed" aria-hidden="true"></i><span class="font-filter"> Cuartos</span></span>
            </div>
              <ul class="list-filter">

                @for ($i = 0; $i < count($cuartos); $i++)
                    <li>
                      <a href="javascript:void(0)" onclick="addFilter('{{ str_slug($cuartos[$i]['numero'],"-") }}','cuartos')">{{ $cuartos[$i]['numero'] }} 
                      @if($cuartos[$i]['numero'] == 1)
                        Cuarto
                      @else
                        Cuartos
                      @endif
                      </a> <span class="cantidad-filter">({{ $cuartos[$i]['cantidad'] }})</span>
                    </li>
                @endfor

              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item" id="seleccion-banos">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-tint" aria-hidden="true"></i><span class="font-filter"> Baños</span></span>
            </div>
              <ul class="list-filter">

                @for ($i = 0; $i < count($banos); $i++)
                    <li>
                      <a href="javascript:void(0)" onclick="addFilter('{{ str_slug($banos[$i]['numero'],"-") }}','banos')">{{ $banos[$i]['numero'] }}
                        @if($banos[$i]['numero'] == 1)
                          Baño
                        @else
                          Baños
                        @endif 
                      </a> <span class="cantidad-filter">({{ $banos[$i]['cantidad'] }})</span></li>
                @endfor
               
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item" id="seleccion-estacionamiento">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-car" aria-hidden="true"></i><span class="font-filter"> Estacionamiento</span></span>
            </div>
              <ul class="list-filter">
  
                @for ($i = 0; $i < count($estacionamiento); $i++)
                    @if($estacionamiento[$i]['numero'] > 0)
                    <li>
                      <a href="javascript:void(0)" onclick="addFilter('{{ str_slug($estacionamiento[$i]['numero'],"-") }}','estacionamiento')">Para {{ $estacionamiento[$i]['numero'] }}
                        @if($estacionamiento[$i]['numero'] == 1)
                          auto
                        @else
                          autos
                        @endif 
                      </a> <span class="cantidad-filter">({{ $estacionamiento[$i]['cantidad'] }})</span></li>
                    @endif
                @endfor
               
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
                <li><a href="#">Fecha de Publicación</a></li>
              </ul>
          </div>
        </div>

      </div>


      <!-- -------------------- Inmuebles ------------------------ -->
      <div class="col-xs-12 col-sm-12 col-md-10">
        <div class="properties-listing spacer"> 

        
            @if($inmuebles)
            @foreach ($inmuebles as $inmueble)
        
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="properties properties-resultados">
                  <a href="{{ url('propiedades').'/'.$inmueble->id.'/'.$inmueble->slug }}">
                  <div class="image-holder">
                    
                    <img src="{{ asset('images/inmuebles').'/'.$inmueble->imagenes }}" class="img-responsive" alt="properties"/>
                    <div class="precio-resultados">$ {{ number_format($inmueble->precio->dolares,0, ',', '.') }}</div>
                    <div class="negociacion-resultados">{{ $inmueble->negociacion->negociacion }}</div>
                  </div>
                  </a>
                   <div class="detalles-resultados">
                       <span>
                          <i class="fa fa-bed"></i> {{ $inmueble->cuartos }} 
                          @if($inmueble->cuartos == 1)
                            Cuarto
                          @else
                            Cuartos 
                          @endif
                        </span>
                       <span>
                          <i class="fa fa-tint"></i> {{ $inmueble->banos }} 
                          @if($inmueble->banos == 1)
                            Baño 
                          @else
                            Baños
                          @endif
                        </span> 
                       <span><i class="fa fa-expand"></i> {{ $inmueble->area_parcela }}m² </span>    
                   </div>
                  <div class="titulo-tipo-resultados">
                    <div class="titulo">
                      <a href="{{ url('propiedades').'/'.$inmueble->id.'/'.$inmueble->slug }}">{{ str_limit($inmueble->titulo,26) }}</a>
                    </div>
                    <div class="tipo">
                      {{ $inmueble->tipo->tipo }}
                    </div>
                  </div> 
                </div>
            </div>

            @endforeach
            @else
                <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-7" style="text-align: center">
                    <h2 style="font-size: 32px;color:#8E8E8E;line-height: 50px;">No se encontraron resultados. Puede seguir buscando desde nuestros filtros.</h2>
                </div>
            @endif
               
        </div>
      </div>  
  </div>


  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-10" style="text-align: center">
     
    </div>
  </div>
</div>

@endsection


@section('javascript')

  <script src="{{ asset('front/assets/funciones.js') }}"></script>

@endsection
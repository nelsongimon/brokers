@extends('layouts.front')

@section('title','Brokers Bienes y Raices')

@section('css')


@endsection


@section('content')


<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        <h2>Se encontraron {{ $cantidad }} propiedades </h2>
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
            @if($filtros)
            <div class="box-filtrar-aplicados">
              Filtros Aplicados
            </div>
            <ul class="list-filter">
              @for ($i = 0; $i < count($filtros); $i++)
                <li><a href="javascript:void(0)" onclick="removeFilter('{{ $filtros[$i]['filtro'] }}')" id="filtro-{{ $filtros[$i]['filtro'] }}" data-{{ $filtros[$i]['filtro'] }}="{{ str_slug($filtros[$i]['valor'],'-') }}"><span class="glyphicon glyphicon-remove"></a> {{ $filtros[$i]['valor'] }}</span></li>
              @endfor
                  
            </ul>
          @else
            <div class="box-filtrar-aplicados" style="padding: 6px 14px;">
              Filtros 
            </div>            
          @endif
          </div>
        </div>  
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <span class="glyphicon glyphicon-map-marker"><span class="font-filter"> Estado</span></span>
            </div>
              <ul class="list-filter">
                @foreach ($estados as $estado)

                  <li><a href="javascript:void(0)"  onclick="addFilter('{{ str_slug($estado->estado,"-") }}','estado')" data-estado="">{{ $estado->estado }}</a> <span class="cantidad-filter">({{ count($estado->inmuebles) }})</span></li>

                @endforeach
                
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-money" aria-hidden="true"></i><span class="font-filter"> Negociación</span></span>
            </div>
              <ul class="list-filter">
                @foreach ($negos as $nego)

                  <li><a href="javascript:void(0)" onclick="addFilter('{{ str_slug($nego->negociacion,"-") }}','negociacion')">{{ $nego->negociacion }}</a> <span class="cantidad-filter">({{ count($nego->inmuebles) }})</span></li>

                @endforeach
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-home" aria-hidden="true"></i><span class="font-filter"> Tipo de inmueble</span></span>
            </div>
              <ul class="list-filter">
                @foreach ($tipos as $tipo)

                  <li><a href="javascript:void(0)"  onclick="addFilter('{{ str_slug($tipo->tipo,"-") }}','tipo')">{{ $tipo->tipo }}</a> <span class="cantidad-filter">({{ count($tipo->inmuebles) }})</span></li>

                @endforeach
              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa fa-bed" aria-hidden="true"></i><span class="font-filter"> Cuartos</span></span>
            </div>
              <ul class="list-filter">

                @for ($i = 0; $i < count($cuartos); $i++)
                    <li><a href="javascript:void(0)" onclick="addFilter('{{ str_slug($cuartos[$i]['numero'],"-") }}','cuartos')">{{ $cuartos[$i]['numero'] }} Cuartos</a> <span class="cantidad-filter">({{ $cuartos[$i]['cantidad'] }})</span></li>
                @endfor

              </ul>
          </div>
        </div>
        <div class="col-xs-12 col-filter-item">
          <div class="box-filter-content">
            <div class="box-filtrar-t">
              <i class="fa fa-tint" aria-hidden="true"></i><span class="font-filter"> Baños</span></span>
            </div>
              <ul class="list-filter">

                @for ($i = 0; $i < count($banos); $i++)
                    <li><a href="javascript:void(0)" onclick="addFilter('{{ str_slug($banos[$i]['numero'],"-") }}','banos')">{{ $banos[$i]['numero'] }} Baños</a> <span class="cantidad-filter">({{ $banos[$i]['cantidad'] }})</span></li>
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
                <li><a href="#">Fecha dePublicación</a></li>
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
                  <a href="{{ url('propiedades').'/'.$inmueble->slug }}">
                  <div class="image-holder">
                      @foreach ($inmueble->imagenes as $imagen)
                        @if($imagen->principal=='yes')
                        <img src="{{ asset('images/inmuebles/Thumb_').$imagen->imagen }}" class="img-responsive" alt="properties"/>
                        @endif
                      @endforeach
                
                    <div class="precio-resultados">Bs {{ number_format($inmueble->precio->dolares,0, ',', '.') }}</div>
                    <div class="negociacion-resultados">{{ $inmueble->negociacion->negociacion }}</div>
                  </div>
                  </a>
                   <div class="detalles-resultados">
                       <span><i class="fa fa-bed"></i> {{ $inmueble->cuartos }} Cuartos </span>
                       <span><i class="fa fa-tint"></i> {{ $inmueble->banos }} Baños </span> 
                       <span><i class="fa fa-expand"></i> {{ $inmueble->area_parcela }}m² </span>    
                   </div>
                  <div class="titulo-tipo-resultados">
                    <div class="titulo">
                      <a href="#">{{ str_limit($inmueble->titulo,26) }}</a>
                    </div>
                    <div class="tipo">
                      {{ $inmueble->tipo->tipo }}
                    </div>
                  </div> 
                </div>
            </div>
            @endforeach
            @else
                <h2>No se encontraron resultados.</h2>
            @endif
               
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

  <script src="{{ asset('front/assets/funciones.js') }}"></script>

@endsection
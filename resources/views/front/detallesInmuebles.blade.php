@extends('layouts.front')

@section('meta')

  <meta property="og:title" content="{{ $inmueble->titulo }}"/>
  <meta property="og:url" content="{{ url('propiedades').'/'.$inmueble->id.'/'.$inmueble->slug }}"/>
  <meta property="og:type" content="article"/>
  @foreach ($inmueble->imagenes as $imagen)
    @if($imagen->principal=='yes')                   
  <meta property="og:image" content="{{ asset('images/inmuebles').'/'.$imagen->imagen }}"/>
    @endif                                  
  @endforeach
  
@endsection

@section('title')
  {{ $inmueble->titulo }}
@endsection

@section('css')


@endsection


@section('content')


<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        <h2>Detalles del inmueble</h2>
    </div>
  </div>

<!-- -------------------- Detalles Inmueble ------------------------ -->


<div class="container">
  <div class="separador2"></div>  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-7">
      <div class="col-sm-12 col-filter-item">
          <div class="panel panel-info panel-modificado">
            <div class="panel-heading">
              <span class="titulos-detalles-lg-inmueble">{{ str_limit($inmueble->titulo,55) }}</span>
            </div>
            <div class="panel-body">
              <div class="hidden-xs hidden-sm">
                  <!-- Gallery image Starts -->
                  <div class="image-holder" id="pic-width">
                    <div id="bigPic">
                      @foreach ($inmueble->imagenes as $imagen)
                        @if($imagen->principal=='yes')
                        <div class="item active">
                          <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}" class="foto-detalle">
                        </div>
                        
                        @else
                          <div class="item">
                            <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}" class="foto-detalle">
                          </div>
                        @endif
                      @endforeach
        
                    </div>
                  </div>
            
                  <ul id="thumbs">
                      @foreach ($inmueble->imagenes as $imagen)
                        @if($imagen->principal=='yes')
                        <div class="item active">
                          <li class='selected' rel='{{ $i = 1 }}'><img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}" /></li>
                        </div>
                        
                        @else
                          <div class="item">
                            <li rel='{{ $i = $i+1 }}'><img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}" /></li>
                          </div>
                        @endif
                      @endforeach
                  </ul>
                  <!-- #Gallery image -->
              </div>
              <div class="hidden-lg hidden-md">
                  <div id="carousel-id" class="carousel slide" data-ride="carousel">
    
                    <div class="carousel-inner">
  
                      @foreach ($inmueble->imagenes as $imagen)
                        @if($imagen->principal=='yes')
                        <div class="item active">
                          <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}" />
                        </div>
                        
                        @else
                          <div class="item">
                            <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}" />
                          </div>
                        @endif
                      @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                  </div>
              </div>
          </div>
      </div>
      </div>
      <div class="col-sm-12 col-filter-item">
          <div class="panel panel-info panel-modificado">
            <div class="panel-heading">
              <span class="titulos-detalles-lg"><spam class="fa fa-map-marker"></spam> Ubicación</span>
            </div>
            <div class="panel-body">
  
                    <p class="texto-detalles-xs-ubicacion">{{ $inmueble->sector->sector.', '.$inmueble->ciudad->ciudad.'. Estado '.$inmueble->estado->estado }}</p>
                    <div id="map"></div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-xs-12 col-sm-12 col-md-5">
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">
            <span class="titulos-detalles-lg"><span class="fa fa-money"></span> Precio {{ $inmueble->negociacion->negociacion }} Bs {{ number_format($inmueble->bolivares,0,',','.') }}</span>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">
            <span class="titulos-detalles-lg"><i class="fa fa-list-ul" aria-hidden="true"></i> Datos principales</span>
          </div>
          <div class="panel-body">
            <ul class="list-datos-principales texto-detalles-md">
              <li><span class="fa  fa-home"></span> &nbsp;&nbsp; {{ $inmueble->tipo->tipo }}</li>
              @if(!empty($inmueble->cuartos))
              <li><span class="fa fa-bed"></span> &nbsp; {{ $inmueble->cuartos }} 
                  @if($inmueble->cuartos == 1)
                    Habitación
                  @else
                    Habitaciones
                  @endif
              </li>
              @endif
              @if(!empty($inmueble->banos))
              <li><span class="fa fa-tint"></span> &nbsp;&nbsp;&nbsp; {{ $inmueble->banos }} 
                  @if($inmueble->banos == 1)
                    Baño
                  @else
                    Baños
                  @endif
              </li>
              @endif
              @if(!empty($inmueble->estacionamientos))
              <li><span class="fa  fa-automobile"></span> &nbsp; {{ $inmueble->estacionamientos }} 
                  @if($inmueble->estacionamientos == 1)
                    Puesto de Estacionamiento
                  @else
                    Puestos de Estacionamiento
                  @endif
              </li>
              @endif
              <li><span class="fa fa-expand"></span> &nbsp;&nbsp; {{ $inmueble->area_construccion }}m² Área de Construcción</li>

              @if(!empty($inmueble->area_parcela))
              <li><span class="fa fa-expand"></span> &nbsp;&nbsp; {{ $inmueble->area_parcela }}m² Área de Parcela</li>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">
            <span class="titulos-detalles-lg"><i class="fa fa-file-text-o"></i> Descripción</span>
          </div>
          <div class="panel-body">
            <p class="texto-detalles-xs">
                {{ $inmueble->descripcion }}
            </p>
          </div>
        </div>
      </div>
      @if($inmueble->nota)
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">
            <span class="titulos-detalles-lg"><i class="fa fa-file-text-o"></i> Nota</span>
          </div>
          <div class="panel-body">
            <p class="texto-detalles-xs">
                {{ $inmueble->nota }}
            </p>
          </div>
        </div>
      </div>
      @endif
      <div class="col-xs-12 col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-body" style="padding: 5px;">
            <div class="col-xs-12 col-sm-4" style="padding: 0px;">
              <img src="{{ asset('images/asesores').'/'.$inmueble->asesor->foto }}" class="foto-agente" alt="agent name">
            </div>
            <div class="col-xs-12 col-sm-8">
              <div class="contenedor-asesor-info">
                  <div class="info-asesor-contacto">{{ $inmueble->asesor->nombre.' '.$inmueble->asesor->apellido }}</div>
                  <div class="info-asesor"><span class="glyphicon glyphicon-envelope"></span>&nbsp; {{ $inmueble->asesor->email }}</div>
                  <div class="info-asesor"><span class="fa fa-phone"></span>&nbsp; {{ $inmueble->asesor->telefono }}</div>
              </div>
            </div>
          </div>
          </div>
      </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('javascript')

  <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpKnb-8ufsQ4kfOnSVHa12H2gbpy2RkFI&callback=initMap">
  </script>


  <script type="text/javascript">

      var currentImage;
      var currentIndex = -1;
      var interval;
      function showImage(index){
          if(index < $('#bigPic img').length){
            var indexImage = $('#bigPic img')[index]
              if(currentImage){   
                if(currentImage != indexImage ){
                      $(currentImage).css('z-index',2);
                      clearTimeout(myTimer);
                      $(currentImage).fadeOut(250, function() {
                myTimer = setTimeout("showNext()",5000);
                $(this).css({'display':'none','z-index':1})
            });
                  }
              }
              $(indexImage).css({'display':'block', 'opacity':1});
              currentImage = indexImage;
              currentIndex = index;
              $('#thumbs li').removeClass('selected');
              $($('#thumbs li')[index]).addClass('selected');
          }
      }
      
      function showNext(){
          var len = $('#bigPic img').length;
          var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
          showImage(next);
      }
      
      var myTimer;
      
      $(document).ready(function() {
        myTimer = setTimeout("showNext()",2000000);
      showNext(); //loads first image
          $('#thumbs li').bind('click',function(e){
            var count = $(this).attr('rel');
            showImage(parseInt(count)-1);
          });
    });

        //Manipulacion de mapas
        function initMap() {
          var myLatlng = new google.maps.LatLng({{ $inmueble->localizacion->latitud }}, {{ $inmueble->localizacion->longitud }});
          var mapOptions = {
            zoom: {{ $inmueble->localizacion->zoom }},
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("map"),
              mapOptions);

          var marker = new google.maps.Marker({
            map: map, 
            draggable: false,
            position: myLatlng
          });

        }
    
  
  </script>

@endsection
<?php 

  //Metrica para determinar la visita de los inmuebles
  $metricas = \App\Metrica::all();
  $verificacion = true;
  foreach ($metricas as $metrica) {
    if($metrica->inmueble_id == $inmueble->id){
      $verificacion = false;
      $id = $metrica->id;
    }
  }

  if($verificacion){
    $metrica = new \App\Metrica;
    $metrica->titulo = $inmueble->titulo;
    $metrica->visitas = 1;
    $metrica->inmueble_id = $inmueble->id;
    $metrica->save();
  }
  else{
    $metrica = \App\Metrica::find($id);
    $metrica->visitas = $metrica->visitas + 1;
    $metrica->save();
  }

 ?>
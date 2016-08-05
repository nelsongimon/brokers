@extends('layouts.front')

@section('title','Brokers Bienes y Raices')

@section('css')


@endsection


@section('content')


<!-- ---------------------- banner -------------------------- -->
  <div class="inside-banner">
    <div class="container"> 
        <h2>Detalles inmueble</h2>
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
              <span class="titulos-detalles-lg">{{ $inmueble->titulo }}</span>
            </div>
            <div class="panel-body">
              <div class="hidden-xs hidden-sm">
                  <!-- Gallery image Starts -->
                  <div class="image-holder">
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
                      <div class="item">
                        <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide" src="images/properties/2.jpg">
                      </div>
                      <div class="item active">
                        <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide" src="images/properties/2.jpg">
                      </div>
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
  
                    <p class="texto-detalles-xs" style="font-size:18px;margin-bottom: 10px;">{{ $inmueble->sector->sector.', '.$inmueble->ciudad->ciudad.' Estado '.$inmueble->estado->estado }}</p>
                    <div id="map" style="height: 400px"></div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-xs-12 col-sm-12 col-md-5">
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">
            <span class="titulos-detalles-lg"><span class="fa fa-money"></span> Precio {{ $inmueble->negociacion->negociacion }} $ {{ number_format($inmueble->precio->dolares,0,'.',',') }}</span>
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
              <li><span class="fa fa-bed"></span> &nbsp; {{ $inmueble->cuartos }} 
                  @if($inmueble->cuartos == 1)
                    Cuarto
                  @else
                    Cuartos
                  @endif
              </li>
              <li><span class="fa fa-tint"></span> &nbsp;&nbsp; {{ $inmueble->banos }} 
                  @if($inmueble->banos == 1)
                    Baño
                  @else
                    Baños
                  @endif
              </li>
              <li><span class="fa  fa-automobile"></span> &nbsp; {{ $inmueble->estacionamientos }} 
                  @if($inmueble->estacionamientos == 1)
                    Puesto de Estacionamiento
                  @else
                    Puestos de Estacionamiento
                  @endif
              </li>
              <li><span class="fa fa-expand"></span> &nbsp;&nbsp; {{ $inmueble->area_construccion }}m² Área de Construcción</li>
              <li><span class="fa fa-expand"></span> &nbsp;&nbsp; {{ $inmueble->area_parcela }}m² Área de Parcela</li>
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
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">  
            <span class="titulos-detalles-lg">Asesor {{ $inmueble->asesor->nombre.' '.$inmueble->asesor->apellido }}</span>        
          </div>
          <div class="panel-body">
            <div class="col-sm-3">
              <img src="{{ asset('images/asesores').'/'.$inmueble->asesor->foto }}" class="img-rounded" width="100%" alt="agent name">
            </div>
            <div class="col-sm-8">
              <div class="contenedor-asesor-info">
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
        myTimer = setTimeout("showNext()",5000);
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
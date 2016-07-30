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
              <span class="titulos-detalles-lg">Título del inmueble</span>
            </div>
            <div class="panel-body">
              <div class="hidden-xs hidden-sm">
                  <!-- Gallery image Starts -->
                  <div class="image-holder">
                    <div id="bigPic">
                      <img src="{{ asset('front/images/properties/1.jpg') }}" alt="" class="foto-detalle" />
                      <img src="{{ asset('front/images/properties/2.jpg') }}" alt="" class="foto-detalle" />
                      <img src="{{ asset('front/images/properties/3.jpg') }}" alt="" class="foto-detalle" />
                      <img src="{{ asset('front/images/properties/4.jpg') }}" alt="" class="foto-detalle" /> 
                    </div>
                  </div>
            
                  <ul id="thumbs">
                    <li class='selected' rel='1'><img src="{{ asset('front/images/properties/1.jpg') }}" alt="" /></li>
                    <li rel='2'><img src="{{ asset('front/images/properties/2.jpg') }}" alt="" /></li>
                    <li rel='3'><img src="{{ asset('front/images/properties/3.jpg') }}" alt="" /></li>
                    <li rel='4'><img src="{{ asset('front/images/properties/4.jpg') }}" alt="" /></li>

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
  
                    <p class="texto-detalles-xs">Urbanización Palo Verde, 3 Etapa, Av. Principal con Calle 12, Parroquia Petare, Municipio Sucre, Lomas Del Avila</p>
                    <div><iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Pulchowk,+Patan,+Central+Region,+Nepal&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Pulchowk,+Patan+Dhoka,+Patan,+Bagmati,+Central+Region,+Nepal&amp;ll=27.678236,85.316853&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe></div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-xs-12 col-sm-12 col-md-5">
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">
            <span class="titulos-detalles-lg"><span class="fa fa-money"></span> Precio Venta Bs 50.000.000</span>
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
              <li><span class="fa  fa-home"></span> &nbsp;&nbsp; Apartamento</li>
              <li><span class="fa fa-bed"></span> &nbsp; 2 Cuartos</li>
              <li><span class="fa fa-tint"></span> &nbsp;&nbsp; 2 Baños</li>
              <li><span class="fa  fa-automobile"></span> &nbsp; 1 Puesto de Estacionamiento</li>
              <li><span class="fa fa-expand"></span> &nbsp;&nbsp; 41m² Área de Construcción</li>
              <li><span class="fa fa-expand"></span> &nbsp;&nbsp; 41m² Área de Parcela</li>
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
                Apartamentos ventilados, iluminados y bellamente acabados, en 
                la zona de mayor crecimiento del este de Caracas. Esta nueva residencia, perteneciente al grupo de edificios construidos 
                anteriormente denominados “CAPRI”, que están ubicados en diversas localidades del 
                este de la ciudad capital, se empezara a construir en el mes de Abril 2015. 

                Esta ubicado en la Urbanización Palo Verde, 3 Etapa, Av. Principal con Calle 12, Parroquia Petare, Municipio Sucre, justo a poca distancia de la estación del metro de Palo Verde y cerca de la estación del metrobús y otros medios alternos de transporte. 
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
                Apartamentos ventilados, iluminados y bellamente acabados, en 
                la zona de mayor crecimiento del este de Caracas. Esta nueva residencia, perteneciente al grupo de edificios construidos 
          
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-filter-item">
        <div class="panel panel-info panel-modificado">
          <div class="panel-heading">  
            <span class="titulos-detalles-lg">Asesor Jorge Bolivar</span>        
          </div>
          <div class="panel-body">
            <div class="col-sm-3">
              <img src="{{ asset('front/images/agents/bolivar.jpg') }}" class="img-rounded" width="100%" alt="agent name">
            </div>
            <div class="col-sm-8">
              <div class="contenedor-asesor-info">
                  <div class="info-asesor"><span class="glyphicon glyphicon-envelope"></span>&nbsp; ejemplo@correo.com</div>
                  <div class="info-asesor"><span class="fa fa-phone"></span>&nbsp; 0424-586 5878</div>
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
    
  
  </script>

@endsection
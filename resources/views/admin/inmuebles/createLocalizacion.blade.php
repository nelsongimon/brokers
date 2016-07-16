@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Inmuebles')

@section('optional-description','Crea un nuevo Inmueble y añádelo a este sitio')

@section('content')

  <div class="row">
    <div class="col-md-11">
      <div class="callout callout-info">
          <h4>Paso 3 de 3: Cargar datos de la localización del Inmueble</h4>
         
      </div>
    </div>
  </div>

  <div class="row">
        <div class="col-md-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Añadir Inmueble</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {!! Form::open(['route'=>'admin.inmuebles.storeLocalizacion','method'=>'post']) !!}

                  <!-- text input -->
                  <div class="form-group col-md-12">
                      <label>Ubicación (descripción)</label>
                      <input type="text" class="form-control" placeholder="Ubicación" name="localizacion">
                  </div>

                  <input type="hidden" id="latitud" name="latitud" value="8.34247126">
                  <input type="hidden" id="longitud" name="longitud" value="-62.59117818">
                  <input type="hidden" id="zoom" name="zoom" value="9">
                 
                 

                  <div class="form-group col-md-12" >
                    <div id="map" style="height: 375px"></div>
                  </div>

                  <div class="form-group col-md-offset-6 col-md-6">
                    <button type="submit" class="btn btn-primary btn-lg pull-right">Finalizar</button>
                  </div>

                  {!! Form::close() !!}
                </div><!-- /.box-body -->
              </div>
      </div>  
</div>



@endsection

@section('javascript')

  
  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>



  <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpKnb-8ufsQ4kfOnSVHa12H2gbpy2RkFI&callback=initMap">
  </script>

  <script type="text/javascript">

        //Manipulacion de mapas
        function initMap() {
          var myLatlng = new google.maps.LatLng(8.34247126, -62.59117818);
          var mapOptions = {
            zoom: 9,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("map"),
              mapOptions);

          var marker = new google.maps.Marker({
            map: map, 
            draggable: true,
            position: myLatlng
          });

          google.maps.event.addListener(marker, 'mouseup', function(){
            moverMarker(marker.getPosition(),map);
          });
        }

  </script>

  <script src="{{ asset('admin/dist/js/funciones.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection

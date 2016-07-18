@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')


@endsection

@section('page-header','Inmuebles')

@section('optional-description')
  
  <a class="btn btn-info" href="{{ url('admin/inmuebles') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Volver</a>

@endsection

@section('content')

	<div class="container">

		<div class="row">

       		<div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $inmueble->titulo }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                 
                    <div class="carousel-inner">

                      @foreach ($inmueble->imagenes as $imagen)
                      	@if($imagen->principal=='yes')
	                      <div class="item active">
	                        <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}">
	              
	                      </div>
	                      
	                      @else
		                      <div class="item">
		                        <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}">
		                      </div>
	                      @endif
                      @endforeach
                
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

			<div class="col-md-5">
                <div class="box-body">
                  <div class="box box-widget widget-user-2">
                                  <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header" style="padding: 10px 40px; background:#325970; border-radius:0px;color:white">
                        
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ asset('images/asesores').'/'.$inmueble->asesor->foto }}" alt="User Avatar" style="width: 70px;margin-right: 15px;">
                        </div><!-- /.widget-user-image -->
                        <h1 class="widget-user-desc" style="font-size: 25px;">{{ $inmueble->asesor->nombre.' '.$inmueble->asesor->apellido }}</h1>
                        <h3 class="widget-user-username" style="font-size: 20px;">Asesor</h3>
                    </div>
                  </div>           
                </div>


              <div class="box box-solid">
                <div class="box-header with-border">
                  
                  <h3 class="box-title">Detalles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul style="list-style: none; font-size: 16px">
                    <li><i class="fa fa-home" aria-hidden="true"></i> {{ $inmueble->tipo->tipo }}</li>
                    <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{ $inmueble->negociacion->negociacion }}</li>
                    <li><i class="fa fa-money" aria-hidden="true"></i> Precio desde {{ number_format($inmueble->precio->dolares,'0',',','.') }} $  </li>
                    <li><i class="fa fa-tint" aria-hidden="true"></i> {{ $inmueble->banos }} Baños </li>
                    <li><i class="fa fa-bed" aria-hidden="true"></i> {{ $inmueble->cuartos }} cuartos</li>
                    <li><i class="fa fa-car" aria-hidden="true"></i> {{ $inmueble->estacionamientos }} puestos de estacionamientos</li>
                    <li><i class="fa fa-expand" aria-hidden="true"></i> {{ $inmueble->area_parcela }} metros Tamaño parcela</li>
                    <li><i class="fa fa-expand" aria-hidden="true"></i> {{ $inmueble->area_construccion }} metros   Tamaño parcela</li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>


    </div>

    <div class="row">
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  
                  <h3 class="box-title">Ubicación: {{ $inmueble->sector->sector.', '.$inmueble->ciudad->ciudad.' Estado '.$inmueble->estado->estado }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="map" style="height: 375px"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>  
			     <div class="col-md-5">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                            Nota
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <p>{{ $inmueble->nota }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="" aria-expanded="true">
                            Descripción
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="box-body">
                          {{ $inmueble->descripcion }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> 

        </div>

     



<!-- --------------------------------------------------------------------------------------- -->        
	</div>
 



	

@endsection

@section('javascript')

  <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpKnb-8ufsQ4kfOnSVHa12H2gbpy2RkFI&callback=initMap">
  </script>

  <script type="text/javascript">

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


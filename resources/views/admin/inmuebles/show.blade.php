@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')


@endsection

@section('page-header','Inmuebles')

@section('optional-description')
  
  <a class="btn btn-info" href="{{ url('admin/inmuebles') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Volver</a>

  <button data-toggle="modal" data-target="#eliminar-inmueble" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true" ></i> Eliminar</button> 

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

              <h2 style="text-align: center; padding: 13px 0px; background: #0E96FF; color:white">
                  @if(!empty($inmueble->metrica->visitas))
                    {{ $inmueble->metrica->visitas }} 
                    @if($inmueble->metrica->visitas == 1)
                      Visita
                    @else
                      Visitas
                    @endif
                  @else
                      0 Visitas
                  @endif
              </h2>

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
                  
                  <h3 class="box-title" style="font-size: 20px">Detalles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul style="list-style: none; font-size: 18px">
                    <li><i class="fa fa-home" aria-hidden="true"></i> {{ $inmueble->tipo->tipo }}</li>
                    <li><i class="fa fa-money" aria-hidden="true"></i> &nbsp;{{ $inmueble->negociacion->negociacion }}</li>
                    @if(!empty($inmueble->banos))
                    <li><i class="fa fa-tint" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;{{ $inmueble->banos }} 
                      @if($inmueble->banos == 1)
                      Baño
                      @else
                      Baños
                      @endif
                    </li>
                    @endif
                    @if(!empty($inmueble->cuartos))
                    <li><i class="fa fa-bed" aria-hidden="true"></i> &nbsp;{{ $inmueble->cuartos }}
                      @if($inmueble->cuartos == 1)
                      Habitación
                      @else
                      Habitaciones
                      @endif
                    </li>
                    @endif
                    @if(!empty($inmueble->estacionamientos))
                    <li><i class="fa fa-car" aria-hidden="true"></i> &nbsp;{{ $inmueble->estacionamientos }} 
                      @if($inmueble->estacionamientos == 1)
                      puesto de estacionamiento
                      @else
                      puestos de estacionamiento
                      @endif
                    </li>
                    @endif

                    @if(!empty($inmueble->area_parcela))
                    <li><i class="fa fa-expand" aria-hidden="true"></i> &nbsp;&nbsp;{{ $inmueble->area_parcela }}m² Área de Parcela</li>
                    @endif
                    
                    <li><i class="fa fa-expand" aria-hidden="true"></i> &nbsp;&nbsp;{{ $inmueble->area_construccion }}m² Área de Construcción</li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </div>


    </div>

    <div class="row">
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  
                  <h3 class="box-title">Ubicación: {{ $inmueble->sector->sector.', '.$inmueble->ciudad->ciudad.'. Estado '.$inmueble->estado->estado }}</h3>
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
                    @if($inmueble->nota)
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
                    @endif
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
              @if(!empty($inmueble->cliente->nombre) or !empty($inmueble->cliente->apellido) or !empty($inmueble->cliente->telefono))
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del cliente</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Nombre:</dt>
                    <dd>{{ $inmueble->cliente->nombre }}</dd>
                    <dt>Apellido:</dt>
                    <dd>{{ $inmueble->cliente->apellido }}</dd>
                    <dt>Teléfono:</dt>
                    <dd>{{ $inmueble->cliente->telefono }}</dd>
                    <dt>Email:</dt>
                    <dd>{{ $inmueble->cliente->email }}</dd>
                  </dl>
                </div><!-- /.box-body -->
              </div>
              @endif


            </div> 

        </div>
       
	</div>
 

  <div class="modal modal-danger fade" id="eliminar-inmueble">  
    <div class="modal-dialog">
      <div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Realmente desea eliminar este Inmueble?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="button-eliminar-inmueble" href="{{ route('admin.inmuebles.destroy',$inmueble->id) }}" class="btn btn-outline">Aceptar</a>
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


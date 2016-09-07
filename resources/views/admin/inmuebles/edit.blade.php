@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">
 

@endsection

@section('page-header','Inmuebles')

@section('optional-description')

  <a class="btn btn-info" href="{{ url('admin/inmuebles') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Volver</a>

@endsection

@section('content')



  <div class="row">
        <div class="col-md-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Inmueble</h3>
                    <div class="col-md-5 pull-right">
                    {!! Form::open(['route'=>'admin.inmuebles.editImagenes','method'=>'post']) !!}
                        <button type="submit" class="btn btn-block btn-social btn-bitbucket">
                          <i class="fa fa-camera-retro" aria-hidden="true"></i> Actualizar el grupo de imágenes del inmueble
                        </button>
                        <input type="hidden" name="id" value="{{ $inmueble->id }}"></input>
                    
                      {!! Form::close() !!}
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {!! Form::open(['route'=>['admin.inmuebles.update',$inmueble->id],'method'=>'put']) !!}
                    <!-- text input -->

                  <fieldset>
                    <legend style="text-align: center;">Datos del Inmuebles</legend>
                    <div class="form-group col-md-6">
                      <label>Título <span style="color: #FF0000;">*</span></label>
                      <input type="text" class="form-control" value="{{ $inmueble->titulo }}" name="titulo">
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Precio ($)</label>
                      <input type="text" class="form-control" value="{{ $inmueble->dolares }}" name="dolares">
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Precio (Bs)</label>
                      <input type="text" class="form-control" value="{{ $inmueble->bolivares }}" name="bolivares">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Asesor <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="asesor_id">
                          @foreach ($asesores as $asesor)
                            @if($inmueble->asesor->id==$asesor->id)
                              <option value="{{ $asesor->id }}" selected>{{ $asesor->nombre.' '.$asesor->apellido }}</option>
                            @else
                              <option value="{{ $asesor->id }}">{{ $asesor->nombre.' '.$asesor->apellido }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Descripción <span style="color: #FF0000;">*</span></label>
                      <textarea class="form-control" rows="4" name="descripcion">{{ $inmueble->descripcion }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Nota</label>
                      <textarea class="form-control" rows="4" name="nota">{{ $inmueble->nota }}</textarea>
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de parcela</label>
                      <input type="text" class="form-control" value="{{ $inmueble->area_parcela }}" name="area_parcela">
                    </div>

                    <!-- select -->
                    <div class="form-group col-md-6">
                        <label>Tipo de Inmueble <span style="color: #FF0000;">*</span></label>
                        <select class="form-control" name="tipo_id">
                          @foreach ($tipos as $tipo)
                            @if($inmueble->tipo->tipo==$tipo->tipo)
                              <option value="{{ $tipo->id }}" selected>{{ $tipo->tipo }}</option>
                            @else
                              <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                            @endif
                          @endforeach
                        </select>
                    </div>
           
                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de construcción <span style="color: #FF0000;">*</span></label>
                      <input type="text" class="form-control" value="{{ $inmueble->area_construccion }}" name="area_construccion">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Tipo de Negociación <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="negociacion_id">
                          @foreach ($negos as $nego)
                            @if($inmueble->negociacion->negociacion==$nego->negociacion)
                              <option value="{{ $nego->id }}" selected>{{ $nego->negociacion }}</option>
                            @else
                              <option value="{{ $nego->id }}">{{ $nego->negociacion }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>
                       
                    <div class="form-group col-md-6">
                      <label>Número de habitaciones</label>
                      <input type="number"  min="0" class="form-control" value="{{ $inmueble->cuartos }}" name="cuartos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Estado <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="estado_id" id="select-estado">
                          @foreach ($estados as $estado)
                            @if($inmueble->sector->estado->estado==$estado->estado)
                              <option value="{{ $estado->id }}" selected>{{ $estado->estado }}</option>
                            @else
                              <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                            @endif
                          @endforeach
                      </select>
                      <input type="hidden" id="token-estado" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="url-estado" value="{{ route('admin.localizacion.sectores.estadosCiudades') }} "></input>
                  </div>
                  
                    <div class="form-group col-md-6">
                      <label>Número de baños</label>
                      <input type="number"  min="0" class="form-control" value="{{ $inmueble->banos }}" name="banos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Ciudad <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="ciudad_id" id="select-ciudad">
                        <option value="{{ $inmueble->sector->ciudad->id }}">{{ $inmueble->sector->ciudad->ciudad }}</option>
                  
                      </select>
                      <input type="hidden" id="token-ciudad" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="url-ciudad" value="{{ route('admin.localizacion.sectores.ciudadesSectores') }} "></input>

                  </div>
                 
                  <div class="form-group col-md-6">
                      <label>Puestos de estacionamientos</label>
                      <input type="number"  min="0" class="form-control" value="{{ $inmueble->estacionamientos }}" name="estacionamientos">
                  </div>

                  <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Sector <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="sector_id" id="select-sector">
                        <option value="{{ $inmueble->sector->id }}">{{ $inmueble->sector->sector }}</option>
               
                      </select>
                  </div>


                </fieldset>
                <fieldset>
                  <legend style="text-align: center;">Datos del Cliente</legend>
                  <div class="form-group col-md-6">
                      <label>Nombre</label>
                      <input type="text" class="form-control" value="{{ $inmueble->cliente->nombre }}" placeholder="Nombre" name="nombre">
                  </div>

                  <div class="form-group col-md-6">
                      <label>Apellido</label>
                      <input type="text" class="form-control" value="{{ $inmueble->cliente->apellido }}" placeholder="Apellido" name="apellido">
                  </div>

                  <div class="form-group col-md-6">
                      <label>Teléfono</label>
                      <input type="text" class="form-control" id="telefono" value="{{ $inmueble->cliente->telefono }}" placeholder="Telefono" name="telefono">
                  </div>

                  <div class="form-group col-md-6">
                      <label>Email</label>
                      <input type="text" class="form-control" placeholder="Email" value="{{ $inmueble->cliente->email }}" name="email">
                  </div>
                    <!-- text input -->
                </fieldset>
                <fieldset>
                  <legend style="text-align: center;">Datos de la Localización</legend>

                  <div class="form-group col-md-12">
                    <div id="map" style="height: 350px"></div>
                    <input type="hidden" id="latitud" name="latitud" value="{{ $inmueble->localizacion->latitud }}">
                    <input type="hidden" id="longitud" name="longitud" value="{{ $inmueble->localizacion->longitud }}">
                    <input type="hidden" id="zoom" name="zoom" value="{{ $inmueble->localizacion->zoom }}">
                  </div>
                </fieldset>

                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"></input>

                  <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Guardar</button>
                  
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

  <script type="text/javascript" src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/input-mask/jquery.inputmask.phone.extensions.js') }}"></script>



  <script type="text/javascript">


        //Manipulacion de mapas
        function initMap() {
          var myLatlng = new google.maps.LatLng({{ $inmueble->localizacion->latitud }},{{ $inmueble->localizacion->longitud }});
          var mapOptions = {
            zoom: {{ $inmueble->localizacion->zoom }},
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

        $('#telefono').inputmask({"mask": "(9999) 999-9999"});
    

  </script>

  <script src="{{ asset('admin/dist/js/funciones.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection

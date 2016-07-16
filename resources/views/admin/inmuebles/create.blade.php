@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
  <link href="{{ asset('admin/plugins/fileInput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />

@endsection

@section('page-header','Inmuebles')

@section('optional-description','Crea un nuevo Inmueble y añádelo a este sitio')

@section('content')

  <div class="row">
    <div class="col-md-11">
      <div class="callout callout-info">
          <h4>Paso 1 de 3: Cargar datos del Inmueble</h4>
         
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
                  {!! Form::open(['route'=>'admin.inmuebles.store','method'=>'post']) !!}
                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Título</label>
                      <input type="text" class="form-control" placeholder="Título" name="titulo">
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Precio</label>
                      <input type="text" class="form-control" placeholder="Precio" name="bolivares">
                    </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Descripción</label>
                      <textarea class="form-control" rows="4" placeholder="Descripción" name="descripcion"></textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Nota</label>
                      <textarea class="form-control" rows="4" placeholder="Nota" name="nota"></textarea>
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de parcela</label>
                      <input type="text" class="form-control" placeholder="Tamaño de parcela (m²)" name="area_parcela">
                    </div>

                    <!-- select -->
                    <div class="form-group col-md-6">
                        <label>Tipo de Inmueble</label>
                        <select class="form-control" name="tipo_id">
                          <option value="">--Seleccione--</option>
                          @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                          @endforeach
                        </select>
                    </div>
           
                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de construcción</label>
                      <input type="text" class="form-control" placeholder="Tamaño de construcción (m²)" name="area_construccion">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Tipo de Negociación</label>
                      <select class="form-control" name="negociacion_id">
                        <option>--Seleccione--</option>
                          @foreach ($negos as $nego)
                            <option value="{{ $nego->id }}">{{ $nego->negociacion }}</option>
                          @endforeach
                      </select>
                  </div>
                       
                    <div class="form-group col-md-6">
                      <label>Número de cuartos</label>
                      <input type="number"  min="0" class="form-control" placeholder="Número de cuartos" name="cuartos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Estado</label>
                      <select class="form-control" name="estado_id" id="select-estado">
                        <option>--Seleccione--</option>
                          @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                          @endforeach
                      </select>
                      <input type="hidden" id="token-estado" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="url-estado" value="{{ route('admin.localizacion.sectores.estadosCiudades') }} "></input>
                  </div>
                  
                    <div class="form-group col-md-6">
                      <label>Número de baños</label>
                      <input type="number"  min="0" class="form-control" placeholder="Número de baños" name="banos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Ciudad</label>
                      <select class="form-control" name="ciudad_id" id="select-ciudad">
                        <option>--Seleccione--</option>
                  
                      </select>
                      <input type="hidden" id="token-ciudad" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="url-ciudad" value="{{ route('admin.localizacion.sectores.ciudadesSectores') }} "></input>

                  </div>
                 
                  <div class="form-group col-md-6">
                      <label>Puestos de estacionamientos</label>
                      <input type="number"  min="0" class="form-control" placeholder="Estacionamientos" name="estacionamientos">
                  </div>

                  <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Sector</label>
                      <select class="form-control" name="sector_id" id="select-sector">
                        <option>--Seleccione--</option>
               
                      </select>
                  </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Asesor</label>
                      <select class="form-control" name="asesor_id">
                        <option>--Seleccione--</option>
                          @foreach ($asesores as $asesor)
                            <option value="{{ $asesor->id }}">{{ $asesor->nombre.' '.$asesor->apellido }}</option>
                          @endforeach
                      </select>
                  </div>

                    <!-- checkbox -->
                    <div class="form-group col-md-6">
                      <label class="">
                        <input type="checkbox" class="minimal" name="status"> &nbsp;&nbsp;&nbsp; Status vendida
                        
                      </label>
                  </div>
                  <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-lg pull-right">Siguiente</button>
                  </div>

                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"></input>

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
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>



  <script type="text/javascript">

      
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
    

  </script>

  <script src="{{ asset('admin/dist/js/funciones.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection
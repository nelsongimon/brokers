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
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Añadir Inmueble</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {!! Form::open(['route'=>'admin.inmuebles.update','method'=>'put']) !!}
                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Título</label>
                      <input type="text" class="form-control" value="{{ $inmueble->titulo }}" name="titulo">
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Precio</label>
                      <input type="text" class="form-control" value="{{ $inmueble->precio->dolares }}" name="dolares">
                    </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Descripción</label>
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
                        <label>Tipo de Inmueble</label>
                        <select class="form-control" name="tipo_id">
                          @foreach ($tipos as $tipo)
                            @if($inmueble->tipo->tipo==$tipo->tipo)
                              <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                            @else
                              <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                            @endif
                          @endforeach
                        </select>
                    </div>
           
                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de construcción</label>
                      <input type="text" class="form-control" value="{{ $inmueble->area_construccion }}" name="area_construccion">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Tipo de Negociación</label>
                      <select class="form-control" name="negociacion_id">
                          @foreach ($negos as $nego)
                            @if($inmueble->negociacion->negociacion==$nego->negociacion)
                              <option value="{{ $nego->id }}">{{ $nego->negociacion }}</option>
                            @else
                              <option value="{{ $nego->id }}">{{ $nego->negociacion }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>
                       
                    <div class="form-group col-md-6">
                      <label>Número de cuartos</label>
                      <input type="number"  min="0" class="form-control" value="{{ $inmueble->cuartos }}" name="cuartos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Estado</label>
                      <select class="form-control" name="estado_id" id="select-estado">
                          @foreach ($estados as $estado)
                            @if($inmueble->sector->estado->estado==$estado->estado)
                              <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
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
                      <label>Ciudad</label>
                      <select class="form-control" name="ciudad_id" id="select-ciudad">
                        <option>{{ $inmueble->sector->ciudad->ciudad }}</option>
                  
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
                      <label>Sector</label>
                      <select class="form-control" name="sector_id" id="select-sector">
                        <option>{{ $inmueble->sector->sector }}</option>
               
                      </select>
                  </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Asesor</label>
                      <select class="form-control" name="asesor_id">
                          @foreach ($asesores as $asesor)
                            @if($inmueble->asesor->id==$asesor->id)
                              <option value="{{ $asesor->id }}">{{ $asesor->nombre.' '.$asesor->apellido }}</option>
                            @else
                              <option value="{{ $asesor->id }}">{{ $asesor->nombre.' '.$asesor->apellido }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>

                    <!-- checkbox -->
                    <div class="form-group col-md-6">
                      <label class="">

                         @if($inmueble->status=='en_venta')
                              <input type="checkbox" class="minimal" name="status"> &nbsp;&nbsp;&nbsp; Status vendida
                         @else
                              <input type="checkbox" class="minimal" name="status" checked> &nbsp;&nbsp;&nbsp; Status vendida
                         @endif
                        
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

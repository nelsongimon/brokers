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
                  <fieldset>
                    <legend style="text-align: center;">Datos del Inmuebles</legend>
                    <div class="form-group col-md-6">
                      <label>Título <span style="color: #FF0000;">*</span></label>
                      <input type="text" class="form-control" value="{{ old('titulo') }}" placeholder="Título" name="titulo">
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Precio ($) <span style="color: #FF0000;">*</span></label>
                      <input type="number"  min="0" class="form-control" value="{{ old('dolares') }}" placeholder="Precio" name="dolares">
                    </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Descripción <span style="color: #FF0000;">*</span></label>
                      <textarea class="form-control" rows="4" name="descripcion" value="{{ old('descripcion') }}" placeholder="Descripción..."></textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group col-md-6">
                      <label>Nota</label>
                      <textarea class="form-control" rows="4" name="nota" value="{{ old('nota') }}" placeholder="Nota..."></textarea>
                    </div>

                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de parcela <span style="color: #FF0000;">*</span></label>
                      <input type="number"  min="0" class="form-control" value="{{ old('area_parcela') }}" placeholder="Tamaño de parcela (m²)" name="area_parcela">
                    </div>

                    <!-- select -->
                    <div class="form-group col-md-6">
                        <label>Tipo de Inmueble <span style="color: #FF0000;">*</span></label>
                        <select class="form-control" name="tipo_id">
                          <option value="">--Seleccione--</option>
                          @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                          @endforeach
                        </select>
                    </div>
           
                    <!-- text input -->
                    <div class="form-group col-md-6">
                      <label>Tamaño de construcción <span style="color: #FF0000;">*</span></label>
                      <input type="number"  min="0" class="form-control" value="{{ old('area_construccion') }}" placeholder="Tamaño de construcción (m²)" name="area_construccion">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Tipo de Negociación <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="negociacion_id">
                        <option value="">--Seleccione--</option>
                          @foreach ($negos as $nego)
                            <option value="{{ $nego->id }}">{{ $nego->negociacion }}</option>
                          @endforeach
                      </select>
                  </div>
                       
                    <div class="form-group col-md-6">
                      <label>Número de cuartos <span style="color: #FF0000;">*</span></label>
                      <input type="number"  min="0" class="form-control" value="{{ old('cuartos') }}" placeholder="Número de cuartos" name="cuartos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Estado <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="estado_id" id="select-estado">
                        <option value="">--Seleccione--</option>
                          @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                          @endforeach
                      </select>
                      <input type="hidden" id="token-estado" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="url-estado" value="{{ route('admin.localizacion.sectores.estadosCiudades') }} "></input>
                  </div>
                  
                    <div class="form-group col-md-6">
                      <label>Número de baños <span style="color: #FF0000;">*</span></label>
                      <input type="number"  min="0" class="form-control" value="{{ old('banos') }}" placeholder="Número de baños" name="banos">
                    </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Ciudad <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="ciudad_id" id="select-ciudad">
                        <option value="">--Seleccione--</option>
                  
                      </select>
                      <input type="hidden" id="token-ciudad" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="url-ciudad" value="{{ route('admin.localizacion.sectores.ciudadesSectores') }} "></input>

                  </div>
                 
                  <div class="form-group col-md-6">
                      <label>Puestos de estacionamiento <span style="color: #FF0000;">*</span></label>
                      <input type="number"  min="0" class="form-control" value="{{ old('estacionamientos') }}" placeholder="Estacionamientos" name="estacionamientos">
                  </div>

                  <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Sector <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="sector_id" id="select-sector">
                        <option value="">--Seleccione--</option>
               
                      </select>
                  </div>

                    <!-- select -->
                  <div class="form-group col-md-6">
                      <label>Asesor <span style="color: #FF0000;">*</span></label>
                      <select class="form-control" name="asesor_id">
                        <option value="">--Seleccione--</option>
                          @foreach ($asesores as $asesor)
                            <option value="{{ $asesor->id }}">{{ $asesor->nombre.' '.$asesor->apellido }}</option>
                          @endforeach
                      </select>
                  </div>

                    <!-- checkbox -->
                  <div class="form-group col-md-6">
                      <label class="">
                        <input type="checkbox" class="minimal" name="status" checked> &nbsp;&nbsp;&nbsp; Disponible
                        
                      </label>
                  </div>
                </fieldset>
                <fieldset>
                  <legend style="text-align: center;">Datos del Cliente (opcional)</legend>

                  <div class="form-group col-md-6">
                      <label>Nombre</label>
                      <input type="text" class="form-control" value="{{ old('nombre') }}" placeholder="Nombre" name="nombre">
                  </div>

                  <div class="form-group col-md-6">
                      <label>Apellido</label>
                      <input type="text" class="form-control" value="{{ old('apellido') }}" placeholder="Apellido" name="apellido">
                  </div>

                  <div class="form-group col-md-6">
                      <label>Teléfono</label>
                      <input type="text" class="form-control" id="telefono" value="{{ old('telefono') }}" placeholder="Telefono" name="telefono">
                  </div>

                  <div class="form-group col-md-6">
                      <label>Email</label>
                      <input type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email">
                  </div>
                </fieldset>

                  <div class="form-group col-md-12">
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
  <script type="text/javascript" src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/input-mask/jquery.inputmask.phone.extensions.js') }}"></script>



  <script type="text/javascript">

      
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });

        $('#telefono').inputmask({"mask": "(9999) 999-9999"});
    

  </script>

  <script src="{{ asset('admin/dist/js/funciones.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection

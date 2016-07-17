@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
  <link href="{{ asset('admin/plugins/fileInput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />

@endsection

@section('page-header','Inmuebles')

@section('optional-description','Crea un nuevo Inmueble y añádelo a este sitio')

@section('content')

  <div class="row">
    <div class="col-md-11">
      <div class="callout callout-info">
          <h4>Paso 2 de 3: Cargar Fotos  del Inmueble</h4>
         
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
                  <div class="col-md-4  ">
                    <a class="btn btn-block btn-social btn-bitbucket" data-toggle="modal" data-target="#foto-principal">
                    <i class="fa fa-camera-retro" aria-hidden="true"></i> Definir la foto principal del inmueble
                  </a>
                  </div>
                  <br><br><br>
                  
                  <div class="col-md-12">
                    {!! Form::open(['route'=>'admin.inmuebles.storeImagenesRestantes','method'=>'post','files'=>true,'class'=>'dropzone','id'=>'fotos-restantes']) !!}
                      
                    {!! Form::close() !!}
                    <br>
                    <div class="col-md-12">
                      <a  href="{{ route('admin.inmuebles.createLocalizacion') }}" class="btn btn-primary btn-lg pull-right">Siguiente</a>
                    </div>
                  </div>
                    
                </div><!-- /.box-body -->
              </div>
      </div>  
</div>

            <div class="modal fade" id="foto-principal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Foto Principal</h4>
                  </div>
                  <div class="modal-body">
                      {!! Form::open(['route'=>'admin.inmuebles.storeImagenPrincipal','method'=>'post','files'=>true,'class'=>'dropzone','id'=>'foto-principal']) !!}
                      
                    {!! Form::close() !!}
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal"   class="btn btn-primary">Guardar</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>


@endsection

@section('javascript')

  
  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/dropzone/dropzone.js') }}"></script>

  


  <script type="text/javascript">

        //Subida de fotos
        Dropzone.options.fotosRestantes={
          dictDefaultMessage: "Arrastre aquí las fotos restantes del inmueble",
          }

        Dropzone.options.fotoPrincipal={
          dictDefaultMessage: "Arrastre aquí la foto principal del inmueble",
          maxFiles: 1,
         }




  </script>

  <script type="text/javascript" src="{{ asset('admin/dist/js/funciones.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection

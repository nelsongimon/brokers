@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">


@endsection

@section('page-header','Inmuebles')

@section('optional-description','Actualiza el grupo de imágenes del inmueble')

@section('content')


  <div class="row">
        <div class="col-md-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Fotos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-info"></i> ¡Importante!</h4>
                      <p style="font-size:17px;">Asegurese de que la primera imagen sea la principal del inmueble.</p>
                  </div>
                  </div>
                  <div class="col-md-12">
                    {!! Form::open(['route'=>'admin.inmuebles.updateImagenes','method'=>'post','files'=>true,'class'=>'dropzone','id'=>'edit-dropzone']) !!}
                      <input type="hidden" name="id" value="{{ $id }}"></input>
                    {!! Form::close() !!}
                    <br>
                    <div class="col-md-12">
                      <a  href="{{ route('admin.inmuebles.edit',$id) }}" class="btn btn-primary btn-lg pull-left">Cancelar</a>
                      <button type="submit" id="submit" class="btn btn-primary btn-lg pull-right">Guardar</button>
                    </div>
                  </div>
                    
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
  <script type="text/javascript" src="{{ asset('admin/plugins/dropzone/dropzone.js') }}"></script>

  


  <script type="text/javascript">

        //Subida de fotos
        Dropzone.options.editDropzone={
            dictDefaultMessage: "Arrastre aquí las fotos del inmueble",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;
                var status=false;
                
                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                    /*
                    if(!status){
                      window.location="{{ url('admin/inmuebles/update') }}";
                    }
                    */
                    
                });
                /*
                this.on("addedfile", function() {
                    status=true;
                });
                */
                this.on("sendingmultiple", function() {
                  // Gets triggered when the form is actually being sent.
                  // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {

                     window.location="{{ route('admin.inmuebles.edit',$id) }}";
                     //console.log(response);
                });
                this.on("errormultiple", function(files, response) {
                  // Gets triggered when there was an error sending the files.
                  // Maybe show form again, and notify user of error
                });
            }
        }

     




  </script>

  <script type="text/javascript" src="{{ asset('admin/dist/js/funciones.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection

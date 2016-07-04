@extends('layouts.admin')

@section('title','Asesores')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Asesores')

@section('optional-description','Añade un nuevo asesor al sitio')

@section('content')
			<div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Añadir Asesor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route'=>'admin.asesores.store','method'=>'post','class'=>'form-horizontal','name'=>'form','files'=>true]) !!}
                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="" name="nombre" placeholder="Nombre">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Apellido</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="" name="apellido" placeholder="Apellido">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Teléfono</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="" name="telefono" placeholder="Teléfono">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id=""  name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-10">
                        <input type="file" class="" id="" name="foto">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" onclick="document.form.reset();" class="btn btn-default">Limpiar</button>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-user-plus" aria-hidden="true"></i> Añadir</button>
                  </div><!-- /.box-footer -->
               
                {!! Form::close() !!}
              </div><!-- /.box -->   
            </div>	
@endsection

@section('javascript')

  
  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>
 

  @include('alerts.mensajes')
  
@endsection
@extends('layouts.admin')

@section('title','Usuarios')

@section('page-header','Usuarios')

@section('optional-description','Crea un nuevo usuario y añádelo a este sitio')

@section('content')
			<div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Añadir Usuario</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route'=>'admin.usuarios.store','method'=>'post','class'=>'form-horizontal','name'=>'form']) !!}
                
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
                      <label for="" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id=""  name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="" name="password" placeholder="Password">
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
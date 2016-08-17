@extends('layouts.admin')

@section('title','Perfil')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">


@endsection

@section('page-header','Perfil de Usuario')

@section('optional-description',' ')

@section('content')

<div class="row">
			<div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Actualizar Perfil</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route'=>'admin.home.perfil','method'=>'post','class'=>'form-horizontal','name'=>'form']) !!}
                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Nombre <span style="color: #FF0000;">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $usuario->nombre }}" name="nombre" placeholder="Nombre">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Apellido <span style="color: #FF0000;">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $usuario->apellido }}" name="apellido" placeholder="Apellido">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Email <span style="color: #FF0000;">*</span></label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" value="{{ $usuario->email }}" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Cambiar Password <span style="color: #FF0000;">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control"  name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Perfil <span style="color: #FF0000;">*</span></label>
                      <div class="col-sm-8">
                        <select name="perfil" class="form-control">
                          @if($usuario->perfil == 'admin')
	                          <option value="admin" selected>Administrador</option>
	                          <option value="member">Miembro</option>
                          @else
                          	  <option value="member" selected>Miembro</option>
	                          <option value="admin">Administrador</option>
                          @endif                        
                        </select>
                      </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $usuario->id }}"></input>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Guardar</button>
                  </div><!-- /.box-footer -->
               
                {!! Form::close() !!}
              </div><!-- /.box -->   
      </div>	

</div>

@endsection

@section('javascript')


  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>

</script>
 

  @include('alerts.mensajes')
  
@endsection

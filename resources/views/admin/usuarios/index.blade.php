@extends('layouts.admin')

@section('title','Usuarios')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
	<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Usuarios')

@section('optional-description','Visualiza a todos los usuarios')

@section('content')



          <div class="row">
            <div class="col-xs-12 col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tabla de usuarios</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Perfil</th>
                        <th>Email</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
					    @foreach ($users as $user)
						<tr>
					    		<td>{{ $user->id }}</td>
					    		<td>{{ $user->nombre }}</td>
					    		<td>{{ $user->apellido }}</td>
					    		<td>
					    			@if($user->perfil=='admin')

										<span class="label label-success" style="font-size:12px;">Administrador</span>

					    			@else

										<span class="label label-warning" style="font-size:12px;">Miembro</span>

					    			@endif
					    		</td>					    		
					    		<td>{{ $user->email }}</td>
					    		<td>

					    		<button class="btn btn-success" onclick="editarUsuario('{{ route('admin.usuarios.edit',$user->id) }}','{{ csrf_token() }}')" data-toggle="modal" data-target="#editar-usuario"><i class="fa fa-pencil" aria-hidden="true" ></i></button>

					    		<button class="btn btn-danger" onclick="eliminarUsuario('{{ route('admin.usuarios.destroy',$user->id) }}')" data-toggle="modal" data-target="#eliminar-usuario"><i class="fa fa-trash" aria-hidden="true" ></i></button>  
  								</td>
						</tr>
					    @endforeach   
                     </tbody>
                    </table>
                  </div>
                </div>
             </div>
          </div>
 



	<div class="modal fade" id="editar-usuario">	
		<div class="modal-dialog">
		 	<div class="modal-content col-xs-offset-1 col-xs-10">

		 		{!! Form::open(["route"=>"admin.usuarios.update","method"=>"put","class"=>"form-horizontal","name"=>"form"]) !!}

		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Editar usuario</h4>
		         </div>
		         <div class="modal-body" align="center">
		                    <div id="datos-usuario">
		                    	
		                    </div>
		                    <div id="form-edit-user" style="display: none" align="left">
								<div class="box-body">
				                    <div class="form-group">
				                      <label for="">Nombre</label>            
				                      <input type="text" class="form-control" id="nombre" name="nombre">
				                    </div>
				                    <div class="form-group">
				                      <label for="">Apellido</label>            
				                      <input type="text" class="form-control" id="apellido" name="apellido">
				                    </div>
				                    <div class="form-group">
				                      <label for="">Email</label>            
				                      <input type="email" class="form-control" id="email" disabled>
				                    </div>
				                	<div class="form-group">
				                      <label for="">Perfil</label>            
				                      <select class="form-control" name="perfil">
				                      		<option value="admin" id="admin">Administrador</option>
				                      		<option value="member" id="member">Miembro</option>
				                      </select>
				                    </div>
				                 </div>
				                 <input type="hidden" name="id" id="id"></input>
		                    </div>
		         </div>
		         <div class="modal-footer">
		                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
		                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Guardar</button>
		          </div>

		          {!! Form::close() !!}
		    </div>
		</div>
	</div>


	<div class="modal modal-danger fade" id="eliminar-usuario">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar a este usuario?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-usuario" href="#" class="btn btn-outline">Aceptar</a>
		        </div>
		    </div>
	    </div>
	</div>


	

@endsection

@section('javascript')

	<script type="text/javascript" src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>
	<script src="{{ asset('admin/dist/js/funciones.js') }}"></script>


	<script type="text/javascript">
		$("#table").DataTable();
	</script>

	@include('alerts.mensajes')
	
@endsection


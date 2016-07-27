@extends('layouts.admin')

@section('title','Asesores')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
	<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Asesores')

@section('optional-description','Administra a todos los Asesores')

@section('content')

          <div class="row">
            <div class="col-xs-12 col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tabla de Asesores</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
					    @foreach ($asesores as $asesor)
						<tr>
					    		<td>{{ $asesor->id }}</td>
					    		<td>{{ $asesor->nombre }}</td>
					    		<td>{{ $asesor->apellido }}</td>
					    		<td>{{ $asesor->telefono }}</td>					    		
					    		<td>{{ $asesor->email }}</td>
					    		<td>

					    			<button class="btn btn-warning" onclick="verAsesor('{{ route('admin.asesores.show',$asesor->id) }}','{{ csrf_token() }}')" data-toggle="modal" data-target="#ver-asesor"><i class="fa fa-eye" aria-hidden="true"></i></button>
		
						    		<button class="btn btn-success" onclick="editarAsesor('{{ route('admin.asesores.edit',$asesor->id) }}','{{ csrf_token() }}')" data-toggle="modal" data-target="#editar-asesor"><i class="fa fa-pencil" aria-hidden="true" ></i></button>

						    		<button class="btn btn-danger" onclick="eliminarAsesor('{{ route('admin.asesores.destroy',$asesor->id) }}')" data-toggle="modal" data-target="#eliminar-asesor"><i class="fa fa-trash" aria-hidden="true" ></i></button> 
					    		</td> 
  
						</tr>
					    @endforeach   
                     </tbody>
                    </table>
                  </div>
                </div>
             </div>
          </div>
 



	<div class="modal fade" id="ver-asesor">	
		<div class="modal-dialog">
		 	
		         <div class="modal-body" align="center">
		                    <div id="status-ver-asesor">
		                    	
		                    </div>
		                    <div id="ventana-ver-asesor" align="left">
								<div class="box-body">
									<div class="box box-widget widget-user-2">
									                <!-- Add the bg color to the header using any of the bg-* classes -->
									  <div class="widget-user-header" style="padding: 20px 40px; background:#325970; border-radius:0px;color:white">
									  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									      <div class="widget-user-image">
									          <img class="img-circle" id="foto-asesor" src="" alt="User Avatar" style="width: 80px;margin-right: 15px;">
									      </div><!-- /.widget-user-image -->
									      <h1 class="widget-user-desc" id="ver-nombre" style="font-size: 27px;"></h1>
									      <h3 class="widget-user-username">Asesor</h3>
									  </div>
									  <div class="box-footer no-padding">
									      <ul class="nav nav-stacked" style="padding: 20px 50px; font-size: 17px">
									          <li><a href="#">Email <span class="pull-right badge bg-blue" id="ver-email" style="font-size: 17px"></span></a></li>
									          <li><a href="#">Teléfono <span class="pull-right badge bg-aqua"id="ver-telefono" style="font-size: 17px"></span></a></li>
									          <li><a href="#">Cantidad de inmuebles <span class="pull-right badge bg-green" id="ver-inmuebles" style="font-size: 17px"style="font-size: 17px"></span></a></li>
									       
									      </ul>
									  </div>
									  
									</div>				   
				                </div>
				                 
		                    </div>
		         </div>		    
		</div>
	</div>


	<div class="modal fade" id="editar-asesor">	
		<div class="modal-dialog">
		 	<div class="modal-content col-xs-offset-1 col-xs-10">

		 		{!! Form::open(["route"=>"admin.asesores.update","method"=>"put","class"=>"form-horizontal","name"=>"form",'files'=>true]) !!}

		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Editar Asesor</h4>
		         </div>
		         <div class="modal-body" align="center">
		                    <div id="status-editar-asesor">
		                    	
		                    </div>
		                    <div id="ventana-editar-asesor" align="left">
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
				                      <label for="">Teléfono</label>            
				                      <input type="text" class="form-control" id="telefono" name="telefono">
				                    </div>
				                    <div class="form-group">
				                      <label for="">Email</label>            
				                      <input type="email" class="form-control" id="email" name="email">
				                    </div>
				                	<div class="form-group">
				                      <label for="">Cambiar Foto</label>            
				                      <input type="file" class=""  name="foto">
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




	<div class="modal modal-danger fade" id="eliminar-asesor">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar a este Asesor?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-asesor" href="#" class="btn btn-outline">Aceptar</a>
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


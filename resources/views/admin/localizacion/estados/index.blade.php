@extends('layouts.admin')

@section('title','Localización')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Estados')

@section('optional-description',' ');

@section('content')



          <div class="row">
			<div class="col-md-6">
	            <div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Estados</h3>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table class="table table-bordered">
	                    @if(count($estados)==0)
	                    <tbody>
							No se encontraron resultados
	                    @else
	                    <tr>
	                      <th>ID</th>
	                      <th>Tipo</th>
	                      <th>Acción</th>
	                    </tr>
	                    	@foreach($estados as $estado)
					        <tr style="font-size: 15px">
		                      <td>{{ $estado->id }}</td>
		                      <td>{{ $estado->estado }}</td>
		                      <td>
		                      	<button class="btn btn-success" onclick="editarEstado('{{ route('admin.localizacion.estados.edit',$estado->id) }}','{{ csrf_token() }}')" ><i class="fa fa-pencil" aria-hidden="true" ></i></button>

					    		<button onclick="eliminarEstado('{{ route('admin.localizacion.estados.destroy',$estado->id) }}')" data-toggle="modal" data-target="#eliminar-estado" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" ></i></button>  
		                      </td>
		                    </tr>
		                    @endforeach
	                    @endif

	                    
	                  </tbody></table>
	                </div><!-- /.box-body -->
	                <div class="box-footer clearfix">
	                  
	        			{!! $estados->render() !!}
	                 
	                </div>
	            </div>
			</div>

			<div class="col-md-5" id="contenedor-form-estados">
				<div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Agregar Estado</h3>
	                </div><!-- /.box-header -->              
	                {!! Form::open(['route'=>'admin.localizacion.estados.store','method'=>'post','name'=>'form']) !!}
	                  <div class="box-body">
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Estado <span style="color: #FF0000;">*</span></label>
	                      <input type="text" class="form-control" id="" name="estado" placeholder="Estado">
	                    </div>
	     
	                  </div><!-- /.box-body -->

	                  <div class="box-footer">
	                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>
	                  </div>
	                {!! Form::close() !!}
	             
                 </div>
      		</div>
			<div class="col-md-5" id="contenedor-form-edit-estado">
                {!! Form::open(['route'=>'admin.localizacion.estados.update','method'=>'put','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group input-group-md">
					      <input type="text" class="form-control" name="estado" id="estado">
					      <input type="hidden" name="id" id="id">
					      <span class="input-group-btn">
					        <button class="btn btn-primary btn-flat" type="submit">Actualizar</button>
					      </span>
					</div>
                {!! Form::close() !!} 
      		</div>	
          </div>

 

	<div class="modal modal-danger fade" id="eliminar-estado">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar este Estado?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-estado" href="#" class="btn btn-outline">Aceptar</a>
		        </div>
		    </div>
	    </div>
	</div>




	

@endsection

@section('javascript')

	<script type="text/javascript" src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>
	<script src="{{ asset('admin/dist/js/funciones.js') }}"></script>



	@include('alerts.mensajes')
	
@endsection

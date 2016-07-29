@extends('layouts.admin')

@section('title','Localización')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Ciudades')

@section('optional-description','Gestione las opciones de las Ciudades');

@section('content')



          <div class="row">
			<div class="col-md-6">
	            <div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Ciudades</h3>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table class="table table-bordered">
	                    @if(count($ciudades)==0)
	                    <tbody>
							No existen registros
	                    @else
	                    <tr>
	                      <th>ID</th>
	                      <th>Ciudad</th>
	                      <th>Estado</th>
	                      <th>Acción</th>
	                    </tr>
	                    	@foreach($ciudades as $ciudad)
					        <tr style="font-size: 15px;">
		                      <td>{{ $ciudad->id }}</td>
		                      <td>{{ $ciudad->ciudad }}</td>
		                      <td>{{ $ciudad->estado->estado }}</td>
		                      <td>
		                      	<button class="btn btn-success" onclick="editarCiudad('{{ route('admin.localizacion.ciudades.edit',$ciudad->id) }}','{{ csrf_token() }}')" ><i class="fa fa-pencil" aria-hidden="true" ></i></button>

					    		<button onclick="eliminarCiudad('{{ route('admin.localizacion.ciudades.destroy',$ciudad->id) }}')" data-toggle="modal" data-target="#eliminar-ciudad" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>  
		                      </td>
		                    </tr>
		                    @endforeach
	                    @endif

	                    
	                  </tbody></table>
	                </div><!-- /.box-body -->
	                <div class="box-footer clearfix">
	                  
	        			{!! $ciudades->render() !!}
	                 
	                </div>
	            </div>
			</div>

			<div class="col-md-5" id="contenedor-form-ciudades">
				<div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Agregar Ciudad</h3>
	                </div><!-- /.box-header -->              
	                {!! Form::open(['route'=>'admin.localizacion.ciudades.store','method'=>'post','name'=>'form']) !!}
	                  <div class="box-body">
	                    <div class="form-group">
	                      <label for="">Ciudad</label>
	                      <input type="text" class="form-control" id="" value="{{ old('ciudad') }}" name="ciudad" placeholder="Ciudad">
	                    </div>
	                    <div class="form-group">
	                      <label for="">Estado</label>
	                      <select name="estado_id" class="form-control" >
	                      		<option value="">--Seleccione--</option>
	                      	@foreach ($estados as $estado)
	                      		<option value="{{ $estado->id }}">{{ $estado->estado }}</option>
	                      	@endforeach
	                      	
	                      </select>
	                    </div>
	     
	                  </div><!-- /.box-body -->

	                  <div class="box-footer">
	                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>
	                  </div>
	                {!! Form::close() !!}
	             
                 </div>
      		</div>
			<div class="col-md-5" id="contenedor-form-edit-ciudad">
                {!! Form::open(['route'=>'admin.localizacion.ciudades.update','method'=>'put','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group input-group-md">
					      <input type="text" class="form-control" name="ciudad" id="ciudad">
					      <input type="hidden" name="id" id="id">
					      <span class="input-group-btn">
					        <button class="btn btn-primary btn-flat" type="submit">Actualizar</button>
					      </span>
					</div>
                {!! Form::close() !!} 
      		</div>	
          </div>


	<div class="modal modal-danger fade" id="eliminar-ciudad">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar esta Ciudad?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-ciudad" href="#" class="btn btn-outline">Aceptar</a>
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

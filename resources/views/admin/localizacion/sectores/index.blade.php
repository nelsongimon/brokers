@extends('layouts.admin')

@section('title','Localización')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Sectores')

@section('optional-description','Gestione las opciones de los Sectores');

@section('content')


	<section class="content">
          <div class="row">
			<div class="col-md-7">
	            <div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Sectores</h3>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table class="table table-bordered">
	                    @if(count($sectores)==0)
	                    <tbody>
							No existen registros
	                    @else
	                    <tr>
	                      <th>ID</th>
	                      <th>Sector</th>
	                      <th>Ciudad</th>
	                      <th>Estado</th>
	                      <th>Acción</th>
	                    </tr>
	                    	@foreach($sectores as $sector)
					        <tr>
		                      <td>{{ $sector->id }}</td>
		                      <td>{{ $sector->sector }}</td>
		                      <td>{{ $sector->ciudad->ciudad }}</td>
		                      <td>{{ $sector->estado->estado }}</td>
		                      <td>
		                      	<button class="btn btn-success" onclick="editarSector('{{ route('admin.localizacion.sectores.edit',$sector->id) }}','{{ csrf_token() }}')" ><i class="fa fa-pencil" aria-hidden="true" ></i></button>

					    		<button onclick="eliminarSector('{{ route('admin.localizacion.sectores.destroy',$sector->id) }}')" data-toggle="modal" data-target="#eliminar-sector" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>  
		                      </td>
		                    </tr>
		                    @endforeach
	                    @endif

	                    
	                  </tbody></table>
	                </div><!-- /.box-body -->
	                <div class="box-footer clearfix">
	                  
	        			{!! $sectores->render() !!}
	                 
	                </div>
	            </div>
			</div>

			<div class="col-md-5" id="contenedor-form-sectores">
				<div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Agregar Sector</h3>
	                </div><!-- /.box-header -->              
	                {!! Form::open(['route'=>'admin.localizacion.sectores.store','method'=>'post','name'=>'form']) !!}
	                  <div class="box-body">
	                    <div class="form-group">
	                      <label for="">Sector</label>
	                      <input type="text" class="form-control" id="" name="sector" placeholder="Sector">
	                    </div>
	                    <div class="form-group">
	                      <label for="">Estado</label>
	                      <select name="estado_id" class="form-control" id="select-estado" >
	                      		<option value="0">--Seleccione--</option>
	                      	@foreach ($estados as $estado)
	                      		<option  value="{{ $estado->id }}">{{ $estado->estado }}</option>
	                      	@endforeach

	                      	
	                      </select>
	                      <input type="hidden" id="token-estado" value="{{ csrf_token() }}"></input>
	                      <input type="hidden" id="url-estado" value="{{ route('admin.localizacion.sectores.estadosCiudades') }} "></input>
	                    </div>
	                    <div class="form-group">
	                      <label for="">Ciudad</label>
	                      <select name="ciudad_id" class="form-control" id="select-ciudad">
	                      		<option value="0">--Seleccione--</option>         	
	                      </select>
	                    </div>
	     
	                  </div><!-- /.box-body -->

	                  <div class="box-footer">
	                    <button type="submit" class="btn btn-primary">Añadir</button>
	                  </div>
	                {!! Form::close() !!}
	             
                 </div>
      		</div>
			<div class="col-md-5" id="contenedor-form-edit-sector">
                {!! Form::open(['route'=>'admin.localizacion.sectores.update','method'=>'put','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group input-group-md">
					      <input type="text" class="form-control" name="sector" id="sector">
					      <input type="hidden" name="id" id="id">
					      <span class="input-group-btn">
					        <button class="btn btn-primary btn-flat" type="submit">Actualizar</button>
					      </span>
					</div>
                {!! Form::close() !!} 
      		</div>	
          </div>

 	</section>

	<div class="modal modal-danger fade" id="eliminar-sector">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar este Sector?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-sector" href="#" class="btn btn-outline">Aceptar</a>
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

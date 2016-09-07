@extends('layouts.admin')

@section('title','Ajustes')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Tipos de Negociaciones')

@section('optional-description','Gestione las opciones para los tipos de Negociaciones');

@section('content')



          <div class="row">
			<div class="col-md-6">
				
				
	            <div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Tipos de Negociación</h3>
	                  <button class="btn btn-info pull-right" id="botan-mostar-form-negociacion"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table class="table table-bordered">
	                    @if(count($negos)==0)
	                    <tbody>
							No se encontraron resultados
	                    @else
	                    <tr>
	                      <th>ID</th>
	                      <th>Tipo</th>
	                      <th>Acción</th>
	                    </tr>
	                    	@foreach($negos as $nego)
					        <tr style="font-size:15px;">
		                      <td>{{ $nego->id }}</td>
		                      <td>{{ $nego->negociacion }}</td>
		                      <td>
		                      	<button class="btn btn-success" onclick="editarNegociacion('{{ route('admin.ajustes.negociacion.edit',$nego->id) }}','{{ csrf_token() }}')" ><i class="fa fa-pencil" aria-hidden="true" ></i></button>

					    		<button onclick="eliminarNegociacion('{{ route('admin.ajustes.negociacion.delete',$nego->id) }}')" class="btn btn-danger" data-toggle="modal" data-target="#eliminar-negociacion"><i class="fa fa-trash" aria-hidden="true" ></i></button>  
		                      </td>
		                    </tr>
		                    @endforeach
	                    @endif

	                    
	                  </tbody></table>
	                </div><!-- /.box-body -->
	                <div class="box-footer clearfix">
	                  
	        			{!! $negos->render() !!}
	                 
	                </div>
	            </div>
			</div>

			<div class="col-md-4" id="contenedor-form-negociacion">
              
                {!! Form::open(['route'=>'admin.ajustes.negociacion.create','method'=>'post','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group">
					      <input type="text" class="form-control" name="negociacion">
					      <span class="input-group-btn">
					        <button class="btn btn-info btn-flat" type="submit">Guardar</button>
					      </span>
					</div>
                {!! Form::close() !!}
                 
      		</div>

			<div class="col-md-4" id="contenedor-form-edit-negociacion">
                {!! Form::open(['route'=>'admin.ajustes.negociacion.update','method'=>'put','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group">
					      <input type="text" class="form-control" name="negociacion" id="negociacion">
					      <input type="hidden" name="id" id="id">
					      <span class="input-group-btn">
					        <button class="btn btn-info btn-flat" type="submit">Actualizar</button>
					      </span>
					</div>
                {!! Form::close() !!} 
      		</div>	
          </div>



	<div class="modal modal-danger fade" id="eliminar-negociacion">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar este tipo de negociación?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-negociacion" href="#" class="btn btn-outline">Aceptar</a>
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

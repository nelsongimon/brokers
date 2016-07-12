@extends('layouts.admin')

@section('title','Ajustes')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Tipos de inmueble')

@section('optional-description','Gestione las opciones para los tipos de inmueble');

@section('content')


	<section class="content">
          <div class="row">
			<div class="col-md-6">
				
				
	            <div class="box">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Tipos de inmueble</h3>
	                  <button class="btn btn-info pull-right" id="botan-mostar-form-tipo"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table class="table table-bordered">
	                    @if(count($tipos)==0)
	                    <tbody>
							No se encontraron resultados
	                    @else
	                    <tr>
	                      <th>ID</th>
	                      <th>Tipo</th>
	                      <th>Acción</th>
	                    </tr>
	                    	@foreach($tipos as $tipo)
					        <tr>
		                      <td>{{ $tipo->id }}</td>
		                      <td>{{ $tipo->tipo }}</td>
		                      <td>
		                      	<button class="btn btn-success" onclick="editarTipos('{{ route('admin.ajustes.tipos.edit',$tipo->id) }}','{{ csrf_token() }}')" ><i class="fa fa-pencil" aria-hidden="true" ></i></button>

					    		<a href="{{ route('admin.ajustes.tipos.delete',$tipo->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" ></i></a>  
		                      </td>
		                    </tr>
		                    @endforeach
	                    @endif

	                    
	                  </tbody></table>
	                </div><!-- /.box-body -->
	                <div class="box-footer clearfix">
	                  
	        			{!! $tipos->render() !!}
	                 
	                </div>
	            </div>
			</div>

			<div class="col-md-4" id="contenedor-form-tipo">
              
                {!! Form::open(['route'=>'admin.ajustes.tipos.create','method'=>'post','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group input-group-lg">
					      <input type="text" class="form-control" name="tipo">
					      <span class="input-group-btn">
					        <button class="btn btn-info btn-flat" type="submit">Guardar</button>
					      </span>
					</div>
                {!! Form::close() !!}
                 
      		</div>

			<div class="col-md-4" id="contenedor-form-edit-tipo">
                {!! Form::open(['route'=>'admin.ajustes.tipos.update','method'=>'put','class'=>'form-horizontal','name'=>'form']) !!}
					<div class="input-group input-group-lg">
					      <input type="text" class="form-control" name="tipo" id="tipo">
					      <input type="hidden" name="id" id="id">
					      <span class="input-group-btn">
					        <button class="btn btn-info btn-flat" type="submit">Actualizar</button>
					      </span>
					</div>
                {!! Form::close() !!} 
      		</div>	
          </div>
 	</section>




	

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

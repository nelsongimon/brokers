@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">

@endsection

@section('page-header','Inmuebles')

@section('optional-description','Visualiza todos los Inmuebles')

@section('content')


	
          <div class="row">
            <div class="col-xs-12 col-md-12">
            {!! Form::open(['route' => 'admin.destacados.store', 'method' => 'post']) !!}
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tabla de Inmuebles</h3>
					<div class="form-group pull-right">
						<select class="form-control" name="action">
		                  	<option value="">Asignación Masiva</option>
		                  	<option value="slider">Agregar al Slider</option>
		                  	<option value="destacados">Agregar a Destacados</option>
	                  	</select>
					</div>
	                <button type="submit" class="btn btn-primary pull-right" style="border-radius:0px">Aplicar</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Negociación</th>
                        <th>Asesor</th>
                        <th>Precio (Bs)</th>
                        <th>Precio ($)</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach ($inmuebles as $inmueble)
						 	<tr>
						 		<td style="text-align: center">
						 			@foreach ($inmueble->imagenes as $imagen)
						 				@if($imagen->principal=='yes')
											<img src="{{ asset('images/inmuebles').'/Thumb_'.$imagen->imagen }}" width="75px">
						 				@endif
						 			@endforeach
						 		</td>
						 		<td>
						 			<input type="checkbox" class="minimal" name="id-{{ $inmueble->id }}" value="{{ $inmueble->id }}"/> &nbsp;&nbsp;{{ str_limit($inmueble->titulo,25) }}
						 		</td>
						 		<td style="text-align: center"> 						 		
						 			@if($inmueble->status=='yes')
										<span class="label label-success" style="font-size: 13px" id="contenedor-status-{{ $inmueble->id }}"><span id="texto-status-{{ $inmueble->id }}">Disponible</span>&nbsp; <a href="javascript:void(0)" style="color:white;" onclick="modificarStatus('{{ $inmueble->id }}','{{ $inmueble->status }}','{{ route('admin.inmuebles.updateStatus') }}')"><i class="fa fa-refresh" id="spin-{{ $inmueble->id }}" aria-hidden="true"></i></a>&nbsp;&nbsp;</span>
						 			@else

										<span class="label label-danger" style="font-size: 13px" id="contenedor-status-{{ $inmueble->id }}"><span id="texto-status-{{ $inmueble->id }}">No Disponible</span>&nbsp; <a href="javascript:void(0)" style="color:white;" onclick="modificarStatus('{{ $inmueble->id }}','{{ $inmueble->status }}','{{ route('admin.inmuebles.updateStatus') }}')"><i class="fa fa-refresh" id="spin-{{ $inmueble->id }}" aria-hidden="true"></i></a>&nbsp;&nbsp;</span>
						 			@endif
									<br>
									
						 	
						 			<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
						 							 		
						 		</td>
						 		<td>{{ $inmueble->negociacion->negociacion }}</td>
						 		<td>{{ $inmueble->asesor->nombre.' '.$inmueble->asesor->apellido }}</td>
								<td>{{ number_format($valor*$inmueble->precio->dolares,0, ',', '.') }}</td>
						 		<td>{{ number_format($inmueble->precio->dolares,0,'.',',') }}</td>
						 		<td>
						 			
									<a  href="{{ route('admin.inmuebles.show',$inmueble->id) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
		
						    		<a href="{{ route('admin.inmuebles.edit',$inmueble->id) }}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true" ></i></a>

						    		<button onclick="eliminarInmueble('{{ route('admin.inmuebles.destroy',$inmueble->id) }}')" data-toggle="modal" data-target="#eliminar-inmueble" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true" ></i></button> 

						 		</td>
						 	</tr>
                    	@endforeach
                     </tbody>
                    </table>
                  </div>
                </div>
                {!! Form::close() !!}
             </div>
             
          </div>
 	


	<div class="modal modal-danger fade" id="eliminar-inmueble">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar este Inmueble?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-inmueble" href="#" class="btn btn-outline">Aceptar</a>
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
	  <!-- iCheck 1.0.1 -->
  	<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('admin/dist/js/funciones.js') }}"></script>


	<script type="text/javascript">
		$("#table").DataTable();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
	</script>

	@include('alerts.mensajes')
	
@endsection


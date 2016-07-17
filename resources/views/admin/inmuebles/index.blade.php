@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
	<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Inmuebles')

@section('optional-description','Visualiza todos los Inmuebles')

@section('content')


	<section class="content">
          <div class="row">
            <div class="col-xs-12 col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tabla de Inmuebles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Título</th>
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
						 		<td>{{ str_limit($inmueble->titulo,35) }}</td>
						 		<td>{{ $inmueble->negociacion->negociacion }}</td>
						 		<td>{{ $inmueble->asesor->nombre.' '.$inmueble->asesor->apellido }}</td>
								<td>{{ number_format($valor*$inmueble->precio->dolares, 2, ',', '.') }}</td>
						 		<td>{{ number_format($inmueble->precio->dolares,2,'.',',') }}</td>
						 		<td>
						 			
									<a  href="{{ url('admin/inmuebles/'.$inmueble->id.'/'.$inmueble->slug) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
		
						    		<button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true" ></i></button>

						    		<button class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true" ></i></button> 

						 		</td>
						 	</tr>
                    	@endforeach
                     </tbody>
                    </table>
                  </div>
                </div>
             </div>
          </div>
 	</section>



	

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


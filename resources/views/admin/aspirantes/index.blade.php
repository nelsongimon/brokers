@extends('layouts.admin')

@section('title','Aspirantes')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
	<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Aspirantes')

@section('optional-description','Visualiza a todos los Aspirantes')

@section('content')



          <div class="row">
            <div class="col-xs-12 col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tabla de Aspirantes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Curriculum</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
					    @foreach ($aspirantes as $aspirante)
						<tr>
					    		<td>{{ $aspirante->id }}</td>
					    		<td>{{ $aspirante->nombre }}</td>
					    		<td>{{ $aspirante->telefono }}</td>
					    		<td>{{ $aspirante->email }}</td>					    		
					    		<td style="text-align: center;"><a href="{{ asset('archivos').'/'.$aspirante->curriculum }}" target="_blank">
					    			@if($aspirante->extension == 'pdf')
					    			<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 27px; color: #E30404"></i>
									@else
									<i class="fa fa-file-word-o" aria-hidden="true" style="font-size: 27px; color: #21198C"></i>
									@endif

					    		</a></td>
					    		<td>
									<button class="btn btn-danger" onclick="eliminarAspirante('{{ route('admin.aspirantes.destroy',$aspirante->id) }}')" data-toggle="modal" data-target="#eliminar-aspirante"><i class="fa fa-trash" aria-hidden="true" ></i></button>  
					    		</td>
  
						</tr>
					    @endforeach   
                     </tbody>
                    </table>
                  </div>
                </div>
             </div>
          </div>
 



	<div class="modal modal-danger fade" id="eliminar-aspirante">	
		<div class="modal-dialog">
			<div class="modal-content col-xs-offset-2 col-xs-8" style="padding: 0px">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Advertencia</h4>
		        </div>
		        <div class="modal-body">
		            <p>¿Realmente desea eliminar a este Aspirante?</p>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
		            <a id="button-eliminar-aspirante" href="#" class="btn btn-outline">Aceptar</a>
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

<?php 

    $notificaciones = \App\Notificacion::all();

    foreach ($notificaciones as $notificacion) {
        if($notificacion->user_id == Auth::user()->id){

            $id = $notificacion->id;
        }
    }

    $notificacion = \App\Notificacion::find($id);
    $notificacion->visto = 'yes';
    $notificacion->save();


?>


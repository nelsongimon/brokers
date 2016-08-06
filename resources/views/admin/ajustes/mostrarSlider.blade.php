@extends('layouts.admin')

@section('title','Ajustes')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Slider')

@section('optional-description','Visualice y elimine los inmuebles que se mostrarán en el slider');

@section('content')


          <div class="row">
			<div class="col-md-7">
				
				
	            <div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Inmuebles del Slider</h3>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  <table class="table table-bordered">
	                    @if(count($sliders)==0)
	                    <tbody>
							No se encontraron resultados
	                    @else
	                    <tr>
	                      <th>Foto</th>
	                      <th>Título</th>
	                      <th>Eliminar</th>
	                    </tr>
	                    	@foreach($sliders as $slider)
					        <tr style="font-size:15px;">
		                      <td style="text-align:center"><img src="{{ asset('images/inmuebles').'/Thumb_'.$slider->imagen }}" width="75px"></td>
		                      <td>{{ $slider->titulo }}</td>
		                      <td>
		                     

					    		<a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" ></i></a>  
		                      </td>
		                    </tr>
		                    @endforeach
	                    @endif

	                    
	                  </tbody></table>
	                </div><!-- /.box-body -->
	                <div class="box-footer clearfix">
	                  
	        			{!! $sliders->render() !!}
	                 
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

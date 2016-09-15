@extends('layouts.admin')

@section('title','Ajustes')

@section('css')

	<link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">

@endsection

@section('page-header','Precio del dolar')

@section('optional-description','Visualiza y actualiza el Precio del Dolar')

@section('content')


	<section class="content">
          <div class="row">
	          <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-green">
	                <div class="inner">
	                  <h3><sup style="font-size: 20px">Bs</sup><span id="precio-dolar">{{ $precio[0]['valor'] }}</span></h3>	
	                  <p>Valor Actual</p>
	                </div>
	                <div class="icon">
	                  <i class="fa fa-usd" aria-hidden="true"></i>
	                </div>
	                <a href="#" id="boton-mostrar-valor-dolar" class="small-box-footer">Actualizar <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div>
	            <div class="col-lg-4 col-xs-12" id="campo-valor-dolar">
					{!! Form::open(['route'=>'admin.ajustes.precio.update','method'=>'post','name'=>'formUpdatePrecio']) !!}
					<div class="input-group input-group-lg">
					      <input type="text" class="form-control" id="form-valor-dolar" name="valor" value="{{ $precio[0]['valor'] }}">
					      <input type="hidden" name="id" value="{{ $precio[0]['id'] }}"></input>
					      <input type="hidden" id="valorfilter" name="valorfilter" value="{{ $precio[0]['valor'] }}"></input>
					      <span class="input-group-btn">
					        <button class="btn btn-info btn-flat" id="boton-actualizar-precio"  type="button">Actualizar</button>
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


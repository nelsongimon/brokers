@extends('layouts.admin')

@section('title','Escritorio')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">


@endsection

@section('page-header','Escritorio')

@section('optional-description',' ')

@section('content')

<div class="row">
	<div class="col-md-3">
		<div class="small-box bg-aqua">
	        <div class="inner">
	            <h3>{{ $inmuebles }}</h3>
	            <p style="font-size: 18px;">
	            @if($asesores == 1)
					Inmueble
	            @else
					Inmuebles
	            @endif
	            </p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-home" aria-hidden="true"></i>
	        </div>
	        <a href="#" class="small-box-footer"></a>
	    </div>
	</div>
	<div class="col-md-3">
		<div class="small-box bg-yellow">
	        <div class="inner">
	            <h3>{{ $asesores }}</h3>
	            <p style="font-size: 18px;">
	            @if($asesores == 1)
					Asesor
	            @else
					Asesores
	            @endif
	            </p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-male" aria-hidden="true"></i>
	        </div>
	        <a href="#" class="small-box-footer"></a>
	    </div>
	</div>
	<div class="col-md-3">
		<div class="small-box bg-green">
	        <div class="inner">
	            <h3>{{ $dolar->valor }}</h3>
	            <p style="font-size: 18px;">Valor Actual</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-usd" aria-hidden="true"></i>
	        </div>
	        <a href="#" class="small-box-footer"></a>
	    </div>
	</div>
	<div class="col-md-9">
			<div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Propiedades más visitadas</h3>
	                  <div class="box-tools pull-right">
	                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	                  </div>
	                </div>
	                <div class="box-body chart-responsive">
	             		<div id="metricas" style="height: 330px"></div>
	                </div><!-- /.box-body -->
			</div>		
	</div>

</div>
@endsection

@section('javascript')

  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>
  <script type="text/javascript">
	$(function () {
	    $('#metricas').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: '7 Propiedades más visitadas'
	        },
	        subtitle: {
	            //text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
	        },
	        xAxis: {
	            type: 'category',
	            labels: {
	                rotation: -45,
	                style: {
	                    fontSize: '9px',
	                    fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Número de Visitas'
	            }
	        },
	        legend: {
	            enabled: false
	        },
	        tooltip: {
	            pointFormat: '<b>{point.y:.0f} Visitas</b>'
	        },
	        series: [{
	            name: 'Propiedades',
	            data: [
	            	@foreach ($metricas as $metrica)
	            		
	                	['{{ str_limit($metrica->titulo,25) }}', {{ $metrica->visitas }}],

	            	@endforeach
	          
	            ],
	            dataLabels: {
	                enabled: true,
	                rotation: -90,
	                color: '#FFFFFF',
	                align: 'right',
	                format: '{point.y:.0f}', // one decimal
	                y: 10, // 10 pixels down from the top
	                style: {
	                    fontSize: '19px',
	                    fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        }]
	    });
	});
  </script>


</script>
 

  @include('alerts.mensajes')
  
@endsection

@extends('layouts.admin')

@section('title','Inmuebles')

@section('css')


@endsection

@section('page-header','Inmuebles')

@section('optional-description','Visualiza todos los Inmuebles')

@section('content')

	<div class="container">
		<div class="row">

       		<div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $inmueble->titulo }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                 
                    <div class="carousel-inner">

                      @foreach ($inmueble->imagenes as $imagen)
                      	@if($imagen->principal=='yes')
	                      <div class="item active">
	                        <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}">
	              
	                      </div>
	                      
	                      @else
		                      <div class="item">
		                        <img src="{{ asset('images/inmuebles').'/'.$imagen->imagen }}" alt="{{ $imagen->imagen }}">
		                      </div>
	                      @endif
                      @endforeach
                
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

			<div class="col-md-5">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-text-width"></i>
                  <h3 class="box-title">Detalles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul>
                    <li style="font-size: 30px;">{{ nl2br($inmueble->descripcion) }}</li>
                    <li>Consectetur adipiscing elit</li>
                    <li>Integer molestie lorem at massa</li>
                    <li>Facilisis in pretium nisl aliquet</li>
                    <li>Faucibus porta lacus fringilla vel</li>
                    <li>Aenean sit amet erat nunc</li>
                    <li>Eget porttitor lorem</li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>


        </div>

        <div class="row">
			<div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Información</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                            Descripcion
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          
                          {{ $inmueble->descripcion }}


                         
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                            Nota
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <p>{{ $inmueble->nota }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="" aria-expanded="true">
                            Collapsible Group Success
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="box-body">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> 
			    	

        </div>



<!-- --------------------------------------------------------------------------------------- -->        
	</div>
 



	

@endsection

@section('javascript')



	
@endsection


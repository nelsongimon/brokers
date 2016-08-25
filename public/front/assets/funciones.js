//--------------------Ajax-----------------------

//Carga dinamica del select ciudad
$('document').ready(function(){
	$('#select-estado').change(function(){

		$('#select-sector').html('<option value="">--Todos--</option>');

		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': $('#token-estado').val()
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				$('#select-ciudad').html('<option value="">--Cargando--</option>');
				$('#select-ciudad-solo').html('<option value="">--Cargando--</option>');
			},
			url: $('#url-estado').val(),
			data:{id:$('#select-estado').val()},
			type: 'POST',
			dataTye: 'json',
			success: function(data){
				if(data.mensaje=="error"){
					$('#select-ciudad').html('<option value="">--Todos--</option>');
					$('#select-ciudad-solo').html('<option value="">--Todos--</option>');

					return false;
				}
				
				$('#select-ciudad').html('<option value="">--Todos--</option>');
				$('#select-ciudad-solo').html('<option value="">--Todos--</option>');
				for(var i=0; i<data.ciudades.length; i++){
					//console.log(data.ciudades[i].ciudad);
					$('#select-ciudad').append('<option value="'+data.ciudades[i].id+'">'+data.ciudades[i].ciudad+'</option>');
					$('#select-ciudad-solo').append('<option value="'+data.ciudades[i].id+'">'+data.ciudades[i].ciudad+'</option>');
				}
			},
			error: function(xhr, status){
				//console.log(status);
			}

		});
	});
});

//Carga dinamica de las opciones de los sectores
$('document').ready(function(){

	//$('.pagination li span,.pagination li a').css('color','blue');


	$('#select-ciudad').change(function(){

		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': $('#token-ciudad').val()
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				$('#select-sector').html('<option value="">--Cargando--</option>');
			},
			url: $('#url-ciudad').val(),
			data:{id:$('#select-ciudad').val()},
			type: 'POST',
			dataTye: 'json',
			success: function(data){
				if(data.mensaje=="error"){
					$('#select-sector').html('<option value="">--Todos--</option>');
					return false;
				}
				$('#select-sector').html('<option value="">--Todos--</option>');
				for(var i=0; i<data.sectores.length; i++){
					//console.log(data.sectores[i].sector);
					$('#select-sector').append('<option value="'+data.sectores[i].id+'">'+data.sectores[i].sector+'</option>');
				}
			},
			error: function(xhr, status){
				//console.log(status);
			}

		});
	});
});


//------------------------------Jquery---------------------------------------

$(document).ready(function(){

	$('#seleccion-ciudades').hide();
	$('#seleccion-sectores').hide();

	if($('#filtro-tipo').data('tipo')){
		$('#seleccion-tipos').hide();
	}
	if($('#filtro-negociacion').data('negociacion')){
		$('#seleccion-negociaciones').hide();
	}
	if($('#filtro-estado').data('estado')){
		$('#seleccion-estados').hide();
		$('#seleccion-ciudades').show();
	}
	if($('#filtro-ciudad').data('ciudad')){
		$('#seleccion-estados').hide();
		$('#seleccion-sectores').show();
	}
	if($('#filtro-sector').data('sector')){
		$('#seleccion-estados').hide();
		$('#seleccion-ciudades').hide();
		$('#seleccion-sectores').hide();
	}
	if($('#filtro-banos').data('banos')){
		$('#seleccion-banos').hide();
	}
	if($('#filtro-cuartos').data('cuartos')){
		$('#seleccion-cuartos').hide();
	}
	if($('#filtro-estacionamiento').data('estacionamiento')){
		$('#seleccion-estacionamiento').hide();
	}
	if($('#filtro-orden').data('orden')){
		$('#seleccion-orden').hide();
	}
	

});


//loader del home de la pagina
$(document).ready(function(){

    var alto = $('#slider').height();
    //$('#slider').hide();
    $('#loader').css({"height": (alto/2)+100+"px"});
    $('#loader').css({"margin-top":(alto/2)-100+"px"}); 
    $('#loader').html('<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:100px;color:#034F7D"></i>');

}) 

$(window).load(function(){

	$("#loader").fadeOut(function(){
		$('#slider').css({"visibility": "visible"});
	});

});

//loader de resultados
$(document).ready(function(){

    var alto = $('#contenedor-inmuebles').height();
    $('#resultados-inmuebles').hide();
    $('#loader-resultados').css({"height": (alto/2)+100+"px"});
    $('#loader-resultados').css({"margin-top":(alto/2)-100+"px"}); 
    $('#loader-resultados').html('<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:100px;color:#034F7D"></i>');

}) 

$(window).load(function(){

	$("#loader-resultados").fadeOut(function(){
		$('#resultados-inmuebles').fadeIn(100);
	});

});





//------------------------------Funciones-------------------------------------



function addFilter(valor,filtro){

	var url = "";

	if(filtro == 'tipo'){
		url += valor;
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

	}
	if(filtro == 'negociacion'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		url += '-en-'+valor;
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}	
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}	
	}
	if(filtro == 'estado' || filtro == 'ciudad' || filtro == 'sector'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		url += '-en-'+valor;
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}		
	}
	if(filtro == 'banos'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if(valor == 1){
			url += '-con-'+valor+'-bano';
		}
		else{
			url += '-con-'+valor+'-banos';
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}	
	}
	if(filtro == 'cuartos'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if(valor == 1){
			url += '-con-'+valor+'-cuarto';
		}
		else{
			url += '-con-'+valor+'-cuartos';
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}
	}
	if(filtro == 'estacionamiento'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if(valor == 1){
			url += '-para-'+valor+'-auto';
		}
		else{
			url += '-para-'+valor+'-autos';
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}
	}
	if(filtro == 'orden'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		url += '-orden-'+valor;
	}

	window.location = url;
}



function removeFilter(filtro){
	var url = "";

	if(filtro == 'tipo'){

		url += 'propiedad';
		
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

		$('#list-filtro-tipo').fadeOut(100);		
	}

	if(filtro == 'negociacion'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-estado').data('estado')){
			url += '-en-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

		$('#list-filtro-negociacion').fadeOut(100);		
	}
	if(filtro == 'estado' || filtro == 'ciudad' || filtro == 'sector'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}

		if(filtro == "ciudad"){
			url += '-en-'+$('#state').data('state');
		}
		if(filtro == 'sector'){
			url += '-en-'+$('#city').data('city');
		}

		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

		$('#list-filtro-estado').fadeOut(100);
		$('#list-filtro-ciudad').fadeOut(100);		
		$('#list-filtro-sector').fadeOut(100);		
	}
	if(filtro == 'banos'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-con-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

		$('#list-filtro-banos').fadeOut(100);	
	}
	if(filtro == 'cuartos'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-con-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

		$('#list-filtro-cuartos').fadeOut(100);	
	}
	if(filtro == 'estacionamiento'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-con-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-orden').data('orden')){
			url += '-orden-'+$('#filtro-orden').data('orden');
		}

		$('#list-filtro-estacionamiento').fadeOut(100);	
	}
	if(filtro == 'orden'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-estado').data('estado')){
			url += '-con-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-ciudad').data('ciudad')){
			url += '-en-'+$('#filtro-ciudad').data('ciudad');
		}
		if($('#filtro-sector').data('sector')){
			url += '-en-'+$('#filtro-sector').data('sector');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-'+$('#filtro-cuartos').data('cuartos');
		}
		if($('#filtro-estacionamiento').data('estacionamiento')){
			url += '-'+$('#filtro-estacionamiento').data('estacionamiento');
		}

		$('#list-filtro-orden').fadeOut(100);	
	}

	window.location = url;
}
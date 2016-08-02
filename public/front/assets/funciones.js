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
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
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
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}	
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
		}	
	}
	if(filtro == 'estado'){
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
		url += '-con-'+valor+'-banos';
		if($('#filtro-cuartos').data('cuartos')){
			url += '-con-'+$('#filtro-cuartos').data('cuartos');
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
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}
		url += '-con-'+valor+'-cuartos';
	}
	//alert(url);
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
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}	
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
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}	
	}
	if(filtro == 'estado'){
		if($('#filtro-tipo').data('tipo')){
			url += $('#filtro-tipo').data('tipo');
		}
		else{
			url += 'propiedad';
	
		}
		if($('#filtro-negociacion').data('negociacion')){
			url += '-en-'+$('#filtro-negociacion').data('negociacion');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
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
			url += '-con-'+$('#filtro-estado').data('estado');
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
			url += '-con-'+$('#filtro-estado').data('estado');
		}
		if($('#filtro-banos').data('banos')){
			url += '-con-'+$('#filtro-banos').data('banos');
		}	
	}
	window.location = url;
}
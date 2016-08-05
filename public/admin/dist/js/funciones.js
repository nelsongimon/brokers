//------------------Ajax------------------------------------


function editarUsuario(url,token){

	$(document).ready(function(){
		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el preloader
			beforeSend: function(){
				$('#form-edit-user').css('display','none');
				$('#datos-usuario')
				.html('<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:60px;color:#C2C1C1"></i>');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#datos-usuario').html('')
				$('#form-edit-user').css('display','block');
				$('#nombre').val(data.nombre);
				$('#apellido').val(data.apellido);
				$('#email').val(data.email);
				$('#id').val(data.id);
				
				if(data.perfil=='admin'){
					$('#admin').attr('selected',true);
					$('#member').attr('selected',false);
				}
				if(data.perfil=='member'){
					$('#member').attr('selected',true);
					$('#admin').attr('selected',false);
				}

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});
	
}


function verAsesor(url,token){


	$(document).ready(function(){
		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el preloader
			beforeSend: function(){
				$('#ventana-ver-asesor').css('display','none');
				$('#status-ver-asesor')
				.html('<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:60px;color:#C2C1C1"></i>');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){

				$('#status-ver-asesor').html('');
				$('#ventana-ver-asesor').css('display','block');
				$('#ver-nombre').html(data.nombre+' '+data.apellido);
				$('#ver-telefono').html(data.telefono);
				$('#ver-email').html(data.email);
				$('#foto-asesor').attr('src',data.foto);
				$('#ver-inmuebles').html(data.inmuebles);		

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});


}


function editarAsesor(url,token){

	$(document).ready(function(){
		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el preloader
			beforeSend: function(){
				$('#ventana-editar-asesor').css('display','none');
				$('#status-editar-asesor')
				.html('<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:60px;color:#C2C1C1"></i>');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#status-editar-asesor').html('')
				$('#ventana-editar-asesor').css('display','block');
				$('#nombre').val(data.nombre);
				$('#apellido').val(data.apellido);
				$('#telefono').val(data.telefono);
				$('#email').val(data.email);
				$('#id').val(data.id);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});
	
}

function editarTipos(url,token){

	$(document).ready(function(){
		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el preloader
			beforeSend: function(){
				$('#contenedor-form-edit-tipo').show();
				$('#tipo').val('Cargando...');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#tipo').val(data.tipo);
				$('#id').val(data.id);
				console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});
	
}

function editarNegociacion(url,token){

	$(document).ready(function(){
		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				$('#contenedor-form-edit-negociacion').show();
				$('#negociacion').val('Cargando...');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#negociacion').val(data.negociacion);
				$('#id').val(data.id);
				console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});
	
}

//Ajustes valor dolar
$('document').ready(function(){
	
	$('#campo-valor-dolar').hide();
	$("#boton-mostrar-valor-dolar").click(function(){
		   $('#campo-valor-dolar').show();
	});

	$('#boton-actualizar-precio').click(function(){

		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': document.formUpdatePrecio._token.value
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el preloader
			beforeSend: function(){
				$('#boton-actualizar-precio')
				.html('<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:18px;color:#FFFFFF"></i> Cargando');
			},
			url: document.formUpdatePrecio.action,
			data:{id:document.formUpdatePrecio.id.value,valor:document.formUpdatePrecio.valor.value},
			type: 'POST',
			success: function(data){
				$('#boton-actualizar-precio').html('Actualizar');
				$('#precio-dolar').html(data.valor);
				$('#form-valor-dolar').val(data.valor);
				$('#valorfilter').val(data.valor);
				$('#campo-valor-dolar').hide();
				//console.log(data);

			},
			error: function(xhr, status){
				//console.log(status);
				$('#boton-actualizar-precio').html('Actualizar');
				$('#campo-valor-dolar').hide();
				$('#form-valor-dolar').val(document.formUpdatePrecio.valorfilter.value);
			}

		});
	});

});

function editarEstado(url, token){

		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				$('#contenedor-form-edit-estado').show();
				$('#estado').val('Cargando...');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#estado').val(data.estado);
				$('#id').val(data.id);
				//console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	
}

function editarCiudad(url, token){

		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				$('#contenedor-form-ciudades').hide();
				$('#contenedor-form-edit-ciudad').show();
				$('#ciudad').val('Cargando...');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#ciudad').val(data.ciudad);
				$('#id').val(data.id);
				//console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	
}
function editarSector(url, token){

		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': token
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				$('#contenedor-form-sectores').hide();
				$('#contenedor-form-edit-sector').show();
				$('#sector').val('Cargando...');
			},
			url: url,
			type: 'GET',
			dataTye: 'json',
			success: function(data){
				$('#sector').val(data.sector);
				$('#id').val(data.id);
				//console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	
}
//Carga dinamica del select ciudad
$('document').ready(function(){
	$('#select-estado').change(function(){

		$('#select-sector').html('<option value="">--Seleccione--</option>');

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
					$('#select-ciudad').html('<option value="">--Seleccione--</option>');
					$('#select-ciudad-solo').html('<option value="">--Seleccione--</option>');
					return false;
				}
				$('#select-ciudad').html('<option value="">--Seleccione--</option>');
				$('#select-ciudad-solo').html('<option value="">--Seleccione--</option>');
				for(var i=0; i<data.ciudades.length; i++){
					//console.log(data.ciudades[i].ciudad);
					$('#select-ciudad').append('<option value="'+data.ciudades[i].id+'">'+data.ciudades[i].ciudad+'</option>');
					$('#select-ciudad-solo').append('<option value="'+data.ciudades[i].id+'">'+data.ciudades[i].ciudad+'</option>');
				}
			},
			error: function(xhr, status){
				console.log(status);
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
					$('#select-sector').html('<option value="">--Seleccione--</option>');
					return false;
				}
				$('#select-sector').html('<option value="">--Seleccione--</option>');
				for(var i=0; i<data.sectores.length; i++){
					console.log(data.sectores[i].sector);
					$('#select-sector').append('<option value="'+data.sectores[i].id+'">'+data.sectores[i].sector+'</option>');
				}
			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});
});

//Modificacion asincrona con el status del inmueble
function modificarStatus(id,status,url){
	//alert(id+' '+status+' '+url);
		$.ajax({
			headers: {
	            'X-CSRF-TOKEN': $('#token').val()
	        },
			//Lo que se va a ejecutar antes de hacer la peticion se coloca el pre-loader
			beforeSend: function(){
				//console.log('cargando...');
				$('#texto-status-'+id).html('Actualizando');
				$('#spin-'+id).addClass('fa-spin');
			},
			url: url,
			data:{id:id},
			type: 'POST',
			dataTye: 'json',
			success: function(data){
				//console.log(data.status);
				if(data.status=='yes'){
					$('#texto-status-'+id).html('Disponible');
					$('#contenedor-status-'+id).removeClass('label-danger');
					$('#contenedor-status-'+id).addClass('label-success');
					$('#spin-'+id).removeClass('fa-spin');
				}
				else{
					$('#texto-status-'+id).html('No disponible');
					$('#contenedor-status-'+id).removeClass('label-success');
					$('#contenedor-status-'+id).addClass('label-danger');
					$('#spin-'+id).removeClass('fa-spin');
				}
			},
			error: function(xhr, status){
				//console.log(status);
			}

		});
}



	
//------------------Jquery---------------------------------------------

$('document').ready(function(){
	$('.box-footer .pagination').css('margin','0px');
	$('#contenedor-form-tipo').hide();
	$('#contenedor-form-negociacion').hide();
	$('#contenedor-form-edit-tipo').hide();
	$('#contenedor-form-edit-negociacion').hide();
	$('#botan-mostar-form-tipo').click(function(){
		$('#contenedor-form-tipo').toggle()
	});
	$('#botan-mostar-form-negociacion').click(function(){
		$('#contenedor-form-negociacion').toggle()
	});
	$('#contenedor-form-edit-estado').hide();
	$('#contenedor-form-edit-ciudad').hide();
	$('#contenedor-form-edit-sector').hide();
	$('#contenedor-form-ciudades').show();
	$('#contenedor-form-sectores').show();




});

//-------------------Funciones-----------------------------------------

function eliminarUsuario(url){

	$('#button-eliminar-usuario').attr('href',url);
	
}

function eliminarAsesor(url){

	$('#button-eliminar-asesor').attr('href',url);
	
}

function eliminarEstado(url){

	$('#button-eliminar-estado').attr('href',url);
	
}

function eliminarCiudad(url){

	$('#button-eliminar-ciudad').attr('href',url);
	
}

function eliminarSector(url){
	$('#button-eliminar-sector').attr('href',url);
}

function eliminarInmueble(url){
	$('#button-eliminar-inmueble').attr('href',url);
}

function eliminarAspirante(url){
	$('#button-eliminar-aspirante').attr('href',url);
}

function moverMarker(marker, map){

	$('#latitud').val(marker.lat());
	$('#longitud').val(marker.lng());
	$('#zoom').val(map.getZoom());
}







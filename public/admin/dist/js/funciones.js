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
				$('#campo-valor-dolar').hide();
				//console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
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
				console.log(data);

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
				console.log(data);

			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	
}
	
//------------------Funciones---------------------------------------------


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

	$('#button-eliminar-estado').attr('href',url);
	
}


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
	$('#contenedor-form-ciudades').show();
});



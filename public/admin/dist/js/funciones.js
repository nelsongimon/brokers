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
	
//------------------Funciones---------------------------------------------


function eliminarUsuario(url){

	$('#button-eliminar-usuario').attr('href',url);
	
}

function eliminarAsesor(url){

	$('#button-eliminar-asesor').attr('href',url);
	
}
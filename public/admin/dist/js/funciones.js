//------------------Ajax----------------------------------------------------------------------
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
			},
			error: function(xhr, status){
				console.log(status);
			}

		});
	});
	
}
	
//------------------Funciones----------------------------------------------------------------------


function eliminarUsuario(url){
	$('#button-eliminar-usuario').attr('href',url);
}
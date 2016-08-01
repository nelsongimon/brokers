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
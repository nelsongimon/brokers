@if(count($errors)>0)

	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		@foreach($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
	</div>

@endif


<!-- ---------------------------------------------------------------------------------------------- -->

@if(Session::has('mensaje-success'))

	<script type="text/javascript">
    	$(document).ready(function(){
        	
        	demo.initChartist();
        	
        	$.notify({
            	icon: '',
            	message: "{{ Session::get('mensaje-success') }}"
            	
            },{
                type: 'success',
                timer: 2000,
                placement: {
	                from: 'top',
	                align: 'center'
            	}
            });
            
    	});
	</script>

@endif

<!-- ---------------------------------------------------------------------------------------------- -->

@if(Session::has('mensaje-error'))

	<script type="text/javascript">
    	$(document).ready(function(){
        	
        	demo.initChartist();
        	
        	$.notify({
            	icon: '',
            	message: "{{ Session::get('mensaje-error') }}"
            	
            },{
                type: 'success',
                timer: 2000,
                placement: {
	                from: 'top',
	                align: 'center'
            	}
            });
            
    	});
	</script>
	
@endif
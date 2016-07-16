@if(count($errors)>0)
    <script type="text/javascript">
        $(document).ready(function(){
            
            demo.initChartist();
            
            $.notify({
                icon: '',
                message: "@foreach($errors->all() as $error) <li style='list-style:none'><i class='fa fa-times' aria-hidden='true'></i>  &nbsp;&nbsp; {{$error}}</li> @endforeach"
                
            },{
                type: 'danger',
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
                type: 'danger',
                timer: 2000,
                placement: {
	                from: 'top',
	                align: 'center'
            	}
            });
            
    	});
	</script>
	
@endif
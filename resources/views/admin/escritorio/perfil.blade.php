@extends('layouts.admin')

@section('title','Perfil')

@section('css')

  <link rel="stylesheet" href="{{ asset('admin/dist/css/animate.min.css') }}">


@endsection

@section('page-header','Perfil de Usuario')

@section('optional-description',' ')

@section('content')

	hola

@endsection

@section('javascript')


  <script type="text/javascript" src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/chartist.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/bootstrap-notify.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/plugins/chartist/demo.js') }}"></script>

</script>
 

  @include('alerts.mensajes')
  
@endsection

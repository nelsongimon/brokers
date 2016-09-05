<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta property="og:site_name" content="Brokers Bienes Raices"/>

  @yield('meta')
  
  <link href="http://i.imgur.com/qIr1k6S.png" rel="icon" type="image/png" />

  <link rel="stylesheet" href="{{ asset('front/assets/bootstrap/css/bootstrap.css') }}" />
 	<link rel="stylesheet" href="{{ asset('front/assets/bootstrap/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('front/assets/style.css') }}"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
  @yield('css')
  <link rel="stylesheet" href="{{ asset('front/assets/main.css') }}"/>

</head>

<body>

<!-- Header Starts -->

<div class="navbar-wrapper">
        <div class="navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                <li ><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('/asesores') }}">Asesores</a></li>
                <li><a href="{{ url('/empleo') }}">Empleo</a></li>         
                <li><a href="{{ url('/busqueda-avanzada') }}">Búsqueda Avanzada</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->
          </div>
        </div>
</div>
<!-- #Header Starts -->

<div class="container">
<!-- Header Starts -->
  <div class="header">
    <div class="row">  
      <div class="col-xs-offset-1 col-xs-10">   
          <a href="{{ url('/') }}"><img src="{{ asset('front/images/brokers_logo.png') }}" class="logo"></a>
          <ul class="pull-right">
            <li><a href="#"><span class="fa fa-facebook-square redes-header"></span></a></li>
            <li><a href="#"><span class="fa fa-instagram redes-header"></span></a></li>
            <li><a href="#"><span class="fa fa-twitter-square redes-header"></span></a></li>          
          </ul>
        </div>
    </div>
  </div>   
</div>
<!-- ------------------------Content-------------------------- -->

  @yield('content')

<!-- ------------------------Footer -------------------------- -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6">
        © Copyright {{ date('Y') }} brokersbienesraices.com
      </div>
      <div class="col-xs-12  col-sm-4 col-md-offset-2 col-md-3">
        <span>Siguenos </span> 
          <a href="#"><span class="fa fa-facebook-square redes-footer"></span></a>
          <a href="#"><span class="fa fa-instagram redes-footer"></span></a>
          <a href="#"><span class="fa fa-twitter-square redes-footer"></span></a>  
      </div>
    </div>
  </div>
</footer>
<!-- ------------------------Footer -------------------------- -->
  <script src="{{ asset('front/assets/bootstrap/js/jquery.js') }}"></script>
  <script src="{{ asset('front/assets/bootstrap/js/bootstrap.js') }}"></script>

  @yield('javascript')

  <script src="{{ asset('front/assets/script.js') }}"></script>

</body>
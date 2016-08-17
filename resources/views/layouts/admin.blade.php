<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> AdminBrokers | @yield('title','Escritorio')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="http://i.imgur.com/qIr1k6S.png" rel="icon" type="image/png" />
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-blue.min.css') }}">

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue fixed">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>B</b>ro</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Panel</b> Admin</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="{{ url('/') }}" target="_blank">
                  <i class="fa fa-globe" aria-hidden="true"></i> &nbsp;Visitar Sitio
                  
                </a>
              </li>
             

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <?php 
                #----------------------------------------------------------------------------------------------
                  //Verificacion de nuevo registro
                  $ingreso = \App\Notificacion::where('user_id','=',Auth::user()->id)->lists('updated_at');


                  if(count($ingreso) > 0){
                    $aspirantes = \App\Aspirante::where('created_at','>',$ingreso[0])->lists('id');  
                    $aspirantes = count($aspirantes); 
                  }
                  else{
                    $aspirantes = 0;
                  }

                  // Se actualiza el visto del usuario
                  if($aspirantes > 0){
                    $notificaciones = \App\Notificacion::all();

                    foreach ($notificaciones as $notificacion) {
                        if($notificacion->user_id == Auth::user()->id){

                            $id = $notificacion->id;
                        }
                    }

                    $notificacion = \App\Notificacion::find($id);
                    $notificacion->visto = 'no';
                    $notificacion->save();
                  }


                  //Notificaciones del sitio
                  $notificaciones = \App\Notificacion::all();
                  $verificacion = true;
                  foreach ($notificaciones as $notificacion) {
                    if($notificacion->user_id == Auth::user()->id){
                      $verificacion = false;
                      $id = $notificacion->id;
                    }
                  }

                  if($verificacion){
                    $notificacion = new \App\Notificacion;
                    $notificacion->user_id = Auth::user()->id;
                    $notificacion->ingresos = 1;
                    $notificacion->save();
                  }
                  else{
                    $notificacion = \App\Notificacion::find($id);
                    $notificacion->user_id = Auth::user()->id;
                    $notificacion->ingresos = $notificacion->ingresos + 1;
                    $notificacion->save();
                  }


                #----------------------------------------------------------------------------------------------
                ?>
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  @if($notificacion->visto == 'no')
                  <span class="label label-success">1</span>
                  @endif
                </a>
                <ul class="dropdown-menu">
                  @if($notificacion->visto == 'no')
                  <li class="header">tienes 1 notificación</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="{{ url('admin/aspirantes') }}">
                          <i class="fa fa-users text-aqua"></i> Nuevos aspirantes se registraron
     
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  @else
                  <li class="header">No tienes notificaciones</li>
                  @endif
                </ul>
              </li>
             
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header" style="height: 120px;">
                    
                    <p style="color:white;">
                      {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} - 
                      @if(Auth::user()->perfil=="admin")
                          Administrador
                      @else
                          Miembro
                      @endif
                      <small>
                          Desde
                          @if($date = new Carbon\Carbon(Auth::user()->created_at))

                              {{  $date->toFormattedDateString() }}

                          @endif

                      </small>
                      
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ url('admin/perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="http://i.imgur.com/uMGuEiB.png" alt="Logo Brokers" style="max-width: 100%;">
            </div>
            <div class="pull-left info">
              <p style="font-size: 15px"></p>
              <!-- Status -->
              
            </div>
          </div>


          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" style="color: white;">
            
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('admin/home') }}" style="color: white; font-size: 15px;" ><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Escritorio</span></a></li>
            @if(Auth::user()->perfil == 'admin')
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="{{ route('admin.usuarios.index') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.usuarios.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Todos los usuarios</a></li>
                <li><a style="color: white; font-size: 15px;" href="{{ route('admin.usuarios.create') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Añadir usuario</a></li>
              </ul>
            </li>
            @endif
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="{{ route('admin.asesores.index') }}"><i class="fa fa-male" aria-hidden="true"></i> <span>Asesores</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.asesores.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Todos los asesores</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.asesores.create') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Añadir asesor</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="{{ route('admin.asesores.index') }}"><i class="fa fa-map" aria-hidden="true"></i> <span>Localización</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.localizacion.estados.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Estados</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.localizacion.ciudades.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Ciudades</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.localizacion.sectores.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sectores</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="{{ route('admin.asesores.index') }}"><i class="fa fa-home" aria-hidden="true"></i> <span>Inmuebles</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.inmuebles.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Todos los Inmuebles</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.inmuebles.create') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Añadir Inmueble</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="{{ route('admin.aspirantes.index') }}"><i class="fa fa-street-view" aria-hidden="true"></i> <span>Aspirantes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.aspirantes.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Ver aspirantes</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="#"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Ajustes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/precio-dolar') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Precio del Dolar</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/tipos-de-inmuebles') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tipos de Inmueble</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/tipos-de-negociacion') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tipos de Negociación</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/slider') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Slider</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/destacados') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Destacados</a></li>
              </ul>

            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('page-header','Page Header')
            <small>@yield('optional-description','Optional description')</small>
          </h1>
        </section>
<!-- ----------------------------------------------------------------------------------------------------- -->
        <!-- Main content -->
        <section class="content">

           @yield('content')

        </section><!-- /.content -->
<!-- ----------------------------------------------------------------------------------------------------- -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">Brokers Bienes y Raices</a>.</strong> Todos los derechos reservados.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-chrome" aria-hidden="true"></i>&nbsp;&nbsp; <i class="fa fa-firefox" aria-hidden="true"></i>&nbsp;&nbsp; <i class="fa fa-opera" aria-hidden="true"></i>&nbsp;&nbsp; <i class="fa fa-internet-explorer" aria-hidden="true"></i>&nbsp;&nbsp; <i class="fa fa-safari" aria-hidden="true"></i></a></li>

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Visitar otras páginas</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="{{ url('/asesores') }}" target="_blank">
                  <i class="menu-icon fa fa-users" style="background: #0070ED; color: white"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Asesores</h4>
                  </div>
                </a>
              </li>
              <li>
                <a href="{{ url('/empleo') }}" target="_blank">
                  <i class="menu-icon fa fa-suitcase" style="background: #0070ED; color: white"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Empleo</h4>
                  </div>
                </a>
              </li>
              <li>
                <a href="{{ url('/busqueda-avanzada') }}" target="_blank">
                  <i class="menu-icon fa fa-search" style="background: #0070ED; color: white"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Búsqueda Avanzada</h4>
                  </div>
                </a>
              </li>
              <li>
                <a href="{{ url('/pasos-para-vender') }}" target="_blank">
                  <i class="menu-icon fa fa-key" style="background: #0070ED; color: white"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Pasos para vender</h4>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->


          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/app.min.js') }}"></script>

    @yield('javascript')

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>

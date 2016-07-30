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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-success">3</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
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
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
            <li><a href="#" style="color: white; font-size: 15px;" ><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Escritorio</span></a></li>
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
              <a style="color: white; font-size: 15px;" href="{{ route('admin.asesores.index') }}"><i class="fa fa-street-view" aria-hidden="true"></i> <span>Aspirantes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.asesores.index') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Todos los asesores</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ route('admin.asesores.create') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Añadir asesor</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a style="color: white; font-size: 15px;" href="#"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Ajustes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/precio-dolar') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Precio del Dolar</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/tipos-de-inmuebles') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tipos de Inmueble</a></li>
                <li><a style="color: #DDDDDD; font-size: 15px;" href="{{ url('admin/ajustes/tipos-de-negociacion') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tipos de Negociación</a></li>
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
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">Brokers Bienes y Raices</a>.</strong> Todos los derechos reservados.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
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

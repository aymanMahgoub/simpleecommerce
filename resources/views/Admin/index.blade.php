<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Simple Ecommerce | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <!--  -->
   
  <!--  -->
  <link rel="stylesheet" href="{{asset('dashBoard/panel-assets/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dashBoard/panel-assets/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashBoard/panel-assets/css/style.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dashBoard/panel-assets/css/skins/_all-skins.min.css')}}">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
   <!-- Bootstrap core mdb.css -->
    <link rel="stylesheet" href="{{ asset('css/mdb.css') }}">
    <!-- Include admin.less file -->
    <link rel="stylesheet" href="{{ asset('less/admin.less') }}">
    <link rel="stylesheet" href="{{ asset('less/app.less') }}">
    <!-- Include app.scss file -->
    <link rel="stylesheet" href="{{ asset('sass/app.scss') }}">
    <!-- Include sweet alert file -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <!-- Include lity light-tbox file -->
    <link rel="stylesheet" href="{{ asset('css/lity.css') }}">
    <!-- Include drop-zone file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <!-- Include Froala Editor style. -->
    <link href="{{ asset('css/froala_editor.min.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

  @yield('stylesheets')
</head>
<body class="hold-transition skin-blue sidebar-mini">
@include('flash::message')
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Admin</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Panel</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">
                {{ Auth::user()->name }}
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/home" class="btn btn-default btn-flat">Home</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                      class="btn btn-default btn-flat">
                                            Logout</a>
                                            
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#dashBoard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Category</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/category"><i class="fa fa-circle-o"></i>All Category</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Products</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/product"><i class="fa fa-circle-o"></i>All Products</a></li>
            
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- @yield('title') -->Simple Ecommerce
        <small>DashBoard <!-- @yield('description') --></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content"> 
      @yield('content')
       <!-- Small boxes (Stat box) -->
    
       <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <section> 
      @yield('footer')
       <!-- Small boxes (Stat box) -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2017-2018 All rights reserved.
  </footer>
    
       <!-- /.row -->
    </section>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery  -->
<script src="{{asset('dashBoard/panel-assets/js/jquery.min.js')}}"></script>
<script src="{{asset('dashBoard/panel-assets/js/ajaxSetup.js')}}"></script>
<script src="{{asset('dashBoard/panel-assets/js/winodowLocation.js')}}"></script>

<!-- Bootstrap 3.3.6 -->
<script src="{{asset('dashBoard/panel-assets/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dashBoard/panel-assets/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dashBoard/panel-assets/js/demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>
<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.9.3/vue-resource.js"></script>
<!-- MDB core JavaScript -->
<script type="application/javascript" src="{{ asset('js/libs/mdb.js') }}"></script>
<!-- Include sweet-alert.js file -->
<script type="application/javascript" src="{{ asset('js/libs/sweetalert.js') }}"></script>
<!-- Include main app.js file -->
<script type="application/javascript" src="{{ asset('js/app.js') }}"></script>
<!-- Include lity light-box js file -->
<script type="application/javascript" src="{{ asset('js/libs/lity.js') }}"></script>
<!-- Include moment.js for chart.js -->
<script type="application/javascript" src="{{ asset('js/libs/moment.js') }}"></script>
<!-- Chart.js plugin -->
<script type="application/javascript" src="{{ asset('js/libs/Chart.js') }}"></script>


@yield('scripts')

<script>
</script>

</body>
</html>

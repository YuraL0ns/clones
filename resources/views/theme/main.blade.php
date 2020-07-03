<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RPC панель | @yield('page-name')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
    <script src="{{asset ('plugins/jquery/jquery.min.js')}}"></script>
  {{--<script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>--}}
  <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset ('css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      
      <span class="brand-text font-weight-light">RPC Панель v.1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      


      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         @guest
            <div class="block">
            <a class="btn btn-block btn-success" href="{{ route('login') }}">{{ __('Войти') }}</a>
            <br>
            @if (Route::has('register'))
            <a class="btn btn-block btn-info" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
            </div>
            @else
        <div class="info">
          <a href="/profile" class="d-block">{{ Auth::user()->first_name }}</a>
        </div>
      </div>
        @endif

        <div class="btn btn-block btn-outline-danger btn-xs" >
            <a class="link-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Выйти из профиля') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

@else
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @can('show project')
          <li class="nav-item">
            <a href="{{ route('project.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Проекты                
              </p>
            </a>
          </li>
          @endcan
          @role('Администратор|Директор|Снабжение|Склад|Инжинер|Конструктор\АСУ')
          <li class="nav-item">
            <a href="/sklader" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Склад                
              </p>
            </a>
          </li>
         <li class="alert alert-danger">
            <strong>Недоступно</strong>
         </li>
          @endrole
        </ul>
      </nav>
@endguest
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('page-name')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
       @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
{{--<script src="{{asset ('plugins/jquery/jquery.min.js')}}"></script>--}}
<!-- Bootstrap 4 -->
<script src="{{asset ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset ('js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset ('js/demo.js')}}"></script>
</body>
</html>

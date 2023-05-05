<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Trispace:wght@600&display=swap" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  {{-- <!-- Custom CSS  -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/style.css') }}"> --}}
  <!-- SweetAlert -->
  <link href="{{ asset('sweetAlert/sweetalert.css') }}">
  <!-- Signature -->
  <link rel="stylesheet" type="text/css" href="{{ asset('keith-wood-signature/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('keith-wood-signature/jquery.signature.css') }}">
  <link type="text/css" href="{{ asset('keith-wood-signature/jquery-ui.css') }}" rel="stylesheet">

  <style>
    .kbw-signature { width: 300px; height: 200px;}
    #sig{
        width: 300px !important;
        height: auto;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </button>
          <div class="dropdown-menu">
            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#changePassword"> Ganti Password <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i></button>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"> {{ __('Logout')}}
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </a>
          </div>
      </div>
    </ul>
  </nav>

    <!-- Modal tambah -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- form -->
            <form action="{{ route('update-password', Auth::user()->id) }}" method="post">
              @csrf
              <div class="form-row col-12 mb-3">
                <label for="current-password" class="form-label">Current Password</label>
                <input name="current-password" type="password" data-toggle="password" class="form-control" id="current-password" placeholder="Current Password" required>
              </div>

              <div class="form-row col-12 mb-3">
                <label for="password" class="form-label">New Password</label>
                <input name="password" type="password" data-toggle="password" class="form-control" id="password" placeholder="New Password" required>
              </div>

              <div class="form-row col-12 mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input name="password_confirmation" data-toggle="password" type="password" class="form-control" id="password_confirmation" placeholder="Confirm New Password" required>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal tambah -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-family: 'Trispace', sans-serif;">APEK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Pengaduan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pengaduan.masuk') }}" class="nav-link {{ request()->is('pengaduan/masuk') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Masuk</p>
                  <span class="badge badge-info right">{{ $masuk }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pengaduan.progres') }}" class="nav-link {{ request()->is('pengaduan/progres') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Progres</p>
                  <span class="badge badge-warning right">{{ $progres }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pengaduan.selesai') }}" class="nav-link {{ request()->is('pengaduan/selesai') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai</p>
                  <span class="badge badge-success right">{{ $selesai }}</span>
                </a>
              </li>
            </ul>
          </li>
          @if(Auth::user()->level == 'admin')
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pelapor') }}" class="nav-link {{ request()->is('pelapor/index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelapor</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('laporan') }}" class="nav-link {{ request()->is('laporan') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('kinerja') }}" class="nav-link {{ request()->is('kinerja') ? 'active' : '' }}">
              <i class="nav-icon fa fa-signal"></i>
              <p>
                Kinerja
                
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('user') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
              <i class="nav-icon far fa fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Main content -->
    <div class="content-wrapper">
      @yield('content')
    </div>



  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Signature Pad -->
<script type="text/javascript" src="{{ asset('keith-wood-signature/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('keith-wood-signature/jquery.ui.touch-punch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('keith-wood-signature/jquery.signature.js') }}"></script>
<!-- SweetAlert -->
<script src="{{ asset('sweetAlert/sweetalert2.all.js') }}"></script>

<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@include('sweetalert::alert')
@yield('signature-pad')
@yield('printLaporan')
@yield('showInput')
@yield('chart')

</body>
</html>

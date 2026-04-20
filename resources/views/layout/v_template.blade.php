<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Administrasi TA | {{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
  <style>
    .main-sidebar { background-color: #1c2e4d !important }
  </style>

</head>

<body class="hold-transition sidebar-mini">
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/logout" class="nav-link flex items-baseline"><i class="fa-solid fa-right-from-bracket pr-2"></i>Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/" class="brand-link">
      <img src="{{asset('img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ ucwords(session('user')['user']->username) }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        @include('layout.v_nav')
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm">
              <ol class="breadcrumb float-sm-left">
                @yield('breadcrumb')
              </ol>
            </div>
          </div>
          <div class="row ml-1">
            @include('layout.v_flash_message')
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="card">
            <div class="card-body">
              @yield('content')
            </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <strong>Copyright &copy; {{ date('Y') }} KoTA 104</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('template')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('template')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{asset('template')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('template')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('template')}}/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(document).ready(function () {
        $("table.display").DataTable({
            "lengthChange" : false,
            "responsive": true,
            "autoWidth": false,
        });
        $("#table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('#new_password, #confirm_password').on('keyup', function () {
        var passwordLength = $('#new_password').val().length;
        if (passwordLength > 6) {
            $('#message').html('');
            if ($('#new_password').val() == $('#confirm_password').val()) {
                $('#message').html('');
                $('#submit').prop('disabled', false);
            }
            else {
                $('#message').html('Password tidak sama');
            }
        }
        else {
            $('#message').html('Password harus 6 karakter atau lebih.');
        }

    });

    $('#status_yes, #status_no').click(function() {
        if($('#status_yes').is(':checked')) {
            $('#prodi_koordinator').prop('disabled', false);
        }
        else if($('#status_no').is(':checked')){
            $('#prodi_koordinator').prop('disabled', true);
        }
    });

    });
  </script>
  <!-- Bootstrap selectpicker -->
  <script>
    $(document).ready(function(){
      $('.search_select_box select').selectpicker();
    });
  </script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
</body>
</html>

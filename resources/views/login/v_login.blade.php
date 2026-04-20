<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
  <style>
    .login-page {
        background-image:   linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                            url('https://images.unsplash.com/photo-1656682775489-489aa1ff4286?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1271&q=80');
        background-repeat: no-repeat;
        background-size: cover;

    }
    .watermark {
      position: absolute;
      bottom: 0;
      left: 2%;
      color: rgb(184, 184, 184);

    }

    .login-box {
      opacity: 70%;
      transition: 0.5s;
    }

    .login-box:hover {
      opacity: 100%;
      transition: 0.5s;
    }

  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    @if(session()->has('loginError'))
        <div class="alert alert-danger" role="alert">
            <i class="fa-solid fa-circle-info mr-2"></i>{{ session('loginError') }}
        </div>
    @endif
  <div class="card">
    <div class="card-body login-card-body">
      <form action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="text-center">
            <a href="#">
              <button class="btn btn-block btn-primary mb-2">Masuk</button>
            </a>
          </div>
      </form>
      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<div class="watermark">
  <p>Copyright &copy; {{ date('Y') }} KoTA 104 All right reserved.</p>
</div>

<!-- jQuery -->
<script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>
</body>
</html>

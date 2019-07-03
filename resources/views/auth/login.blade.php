<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sign In | {{ env('APP_NAME') }}</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/Ionicons/css/ionicons.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/square/blue.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!-- Custom Style -->
  <link rel="stylesheet" href="{!! asset('css/backend-style.css')!!}" />
</head>

<body class="hold-transition login-page" style="height:auto;">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">
        <b>Admin</b>Login</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @include('layouts.backend.alert')

      <form id="sign_in" action="{{ route('auth.login') }}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group has-feedback">
          <input type="username" class="form-control"  name="username" placeholder="Username" value="{!! old('username') !!}" required autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control"  name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->

        </div>
      </form>

    </div>
    <p class="text-center mt-2">CMS Powered By - Dradtech Technology</p>
    <!-- /.login-box-body -->

  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

  <!-- iCheck -->
  <script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>

</body>

</html>
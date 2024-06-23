<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("adminlte/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- icheck bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset("adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("adminlte/dist/css/adminlte.min.css")}}">
  <style>
    .upload-info {
      margin-top: -10px; /* Adjust this value as needed */
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ asset("adminlte/index2.html")}}" class="h1"><b>Register</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
      <form action="{{ route("register.auth")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Name" name="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="confirm_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" placeholder="Upload Photos" name="profil_img"  enctype='multipart/form-data'>
            <div class="input-group-append">  
              <div class="input-group-text">
                <span class="fas fa-file"></span>
              </div>
          </div>
        </div>
        <div class="mb-4 upload-info">
          <small class="form-text text-muted">Upload foto: jpg, jpeg, png</small>
        </div>

          {{-- <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Pilih Foto</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputFoto" name="profil_img"  enctype='multipart/form-data'>
                <label class="custom-file-label" for="inputFoto">Choose file</label>
            </div>
        </div> --}}

        {{-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> --}}
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login" class="text-center">I already have a member</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset("adminlte/plugins/jquery/jquery.min.js")}}></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<!-- AdminLTE App -->
<script src="{{ asset("adminlte/dist/js/adminlte.min.js")}}></script>
</body>
</html>

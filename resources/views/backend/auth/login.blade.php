<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Love Physics') }}</title>
    <!-- Fonts and Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('css/a-app.css') }}" type="text/css">
    <style>
    .be-left-sidebar .sidebar-elements>li ul {
        padding: 0;
    }

    #inputSmall {
      width: 360px;
    }
    </style>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="card card-border-color card-border-color-primary">
              <div class="card-header">
                <a href="{{ url('/') }}">
                    <img class="logo-img" style="max-width:50px" src="{{ url('logo.png') }}" alt="logo">
                </a>
                <span class="splash-description">Please enter your user information.</span>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ url('/admin/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>

                        @if ($errors->has('email') || session()->has('error'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                <strong style="color: red;">{{ session('error') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row login-tools">
                        <div class="col-6 login-remember">
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="remember" type="checkbox">
                                <span class="custom-control-label">Remember Me</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group login-submit">
                        <button class="btn btn-primary btn-xl">Sign me in</button>
                        <a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ url('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/a-app.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //-initialize the javascript
        App.init();
      });

    </script>
</body>
</html>

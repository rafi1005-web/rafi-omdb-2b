<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ __('auth.login') }} &mdash; Stisla</title>
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="text-center mb-3">
              <div class="dropdown d-inline">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                  <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a>
                  <a class="dropdown-item" href="{{ route('lang.switch', 'id') }}">Bahasa Indonesia</a>
                </div>
              </div>
            </div>
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>
            @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>
            @endif
            <div class="card card-primary">
              <div class="card-header"><h4>{{ __('auth.login') }}</h4></div>
              <div class="card-body">
                <form method="POST" action="{{ route('signin') }}">
                  @csrf
                  <div class="form-group">
                    <label for="email">{{ __('auth.username') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                  </div>
                  <div class="form-group">
                    <label for="password">{{ __('auth.password') }}</label>
                    <input id="password" type="password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('auth.login') }}</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">{{ __('auth.no_account') }} <a href="{{ route('register') }}">{{ __('auth.create_one') }}</a></div>
            <div class="simple-footer">Copyright &copy; Stisla {{ date('Y') }}</div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
</body>
</html>

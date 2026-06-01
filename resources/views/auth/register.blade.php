<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ __('auth.register') }} &mdash; Stisla</title>

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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

            <div class="login-brand">
              <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="text-center mb-4">
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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle"></i> {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif

            <div class="card card-primary">
              <div class="card-header"><h4>{{ __('auth.register') }}</h4></div>
              <div class="card-body">
                <form method="POST" action="{{ route('signup') }}" novalidate>
                  @csrf
                  <div class="form-group">
                    <label for="name">{{ __('auth.full_name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="form-group">
                    <label for="email">{{ __('auth.email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password">{{ __('auth.password') }}</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation">{{ __('auth.password_confirmation') }}</label>
                      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                      @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('auth.register') }}</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="mt-5 text-muted text-center">
              {{ __('auth.already_have_account') }} <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
            </div>

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

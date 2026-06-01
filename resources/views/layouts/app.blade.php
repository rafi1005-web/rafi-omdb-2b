<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>OMDB RAFI</title>

  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
              <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a>
              <a class="dropdown-item" href="{{ route('lang.switch', 'id') }}">Bahasa Indonesia</a>
            </div>
          </li>


          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">
                {{ __('auth.hi') }}, {{ Auth::user()->name ?? 'User' }}
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item has-icon text-danger" style="width: 100%; background: none; border: none; text-align: left; cursor: pointer;">
                  <i class="fas fa-sign-out-alt"></i> {{ __('auth.logout') }}
                </button>
              </form>
            </div>
          </li>
        </ul>
      </nav>


      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand"><a href="{{ route('dashboard') }}">OMDB RAFI</a></div>
          <div class="sidebar-brand sidebar-brand-sm"><a href="{{ route('dashboard') }}">OR</a></div>
          <ul class="sidebar-menu">
            <li class="menu-header">{{ __('dashboard.dashboard') }}</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Movies</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('movies.all') }}">{{ __('dashboard.all_movies') }}</a></li>
                <li><a class="nav-link" href="{{ route('movies.index') }}">{{ __('dashboard.search_movies') }}</a></li>
                <li><a class="nav-link" href="{{ route('movies.favorite') }}">{{ __('dashboard.favorite_movies') }}</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>


      <div class="main-content">
        @yield('content')
      </div>


      <footer class="main-footer">
        <div class="footer-left">Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Design By RAFI RIZKY PRATAMA</div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if(session('success'))
    Swal.fire({ text: "{{ session('success') }}", icon: "success", toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    @endif
    @if(session('error'))
    Swal.fire({ text: "{{ session('error') }}", icon: "error", toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    @endif
    @if(session('warning'))
    Swal.fire({ text: "{{ session('warning') }}", icon: "warning", toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    @endif
  </script>
  @stack('scripts')
</body>
</html>

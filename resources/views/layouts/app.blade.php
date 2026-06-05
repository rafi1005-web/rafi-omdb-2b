<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>OMDB RAFI</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  <style>

    .sidebar-menu li a span {
      color: #6c757d !important;
    }
    .sidebar-menu .nav-item.dropdown.active > a span,
    .sidebar-menu .nav-item.dropdown > a:hover span {
      color: #6777ef !important;
    }
    .sidebar-menu .dropdown-menu li a span {
      color: #6c757d !important;
    }
    .sidebar-menu .dropdown-menu li.active a span {
      color: #6777ef !important;
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <!-- Navbar -->
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

          <!-- Dropdown User -->
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">
                {{ __('auth.hi') }}, {{ Auth::user()->name ?? 'User' }}
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">


              @if(Auth::check())
                @php
                  $waktuSekarang = \Carbon\Carbon::now('Asia/Jakarta');
                  $waktuLogin = Auth::user()->updated_at
                      ? \Carbon\Carbon::parse(Auth::user()->updated_at)->tz('Asia/Jakarta')
                      : $waktuSekarang;


                  $totalMenit = (int) abs($waktuSekarang->diffInMinutes($waktuLogin));


                  $hitungJam = floor($totalMenit / 60);
                  $sisaMenit = $totalMenit % 60;
                @endphp

                <div class="dropdown-title">
                  {{ __('auth.logged_in') }}

                  @if($totalMenit == 0)
                    {{ __('auth.just_now') }}
                  @else

                    @if($hitungJam > 0)
                      @if($hitungJam == 1)
                        {{ __('auth.hour_ago') }}
                      @else
                        {{ $hitungJam }} {{ __('auth.hours_ago') }}
                      @endif
                    @endif


                    @if($sisaMenit > 0)
                      @if($sisaMenit == 1)
                        {{ __('auth.minute_ago') }}
                      @else
                        {{ $sisaMenit }} {{ __('auth.minutes_ago') }}
                      @endif
                    @endif
                  @endif
                </div>
              @endif

              <div class="dropdown-divider"></div>


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

      <!-- Sidebar Wrapper -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand"><a href="{{ route('dashboard') }}">OMDB RAFI</a></div>
          <div class="sidebar-brand sidebar-brand-sm"><a href="{{ route('dashboard') }}">OR</a></div>

          <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li class="nav-item dropdown {{ Request::is('movies*') || Request::is('favorites*') ? 'active' : '' }}">
              <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-fire"></i>
                <span>Movies</span>
              </a>
              <ul class="dropdown-menu">
                <li class="{{ Request::is('movies') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('movies.index') }}">{{ __('auth.search_movies') }}</a>
                </li>
                <li class="{{ Request::is('favorites*') || Request::is('movies/favorite') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('movies.favorite') }}">{{ __('auth.favorite_movies') }}</a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>


      <div class="main-content">
        @yield('content')
      </div>

      <!-- Footer -->
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
    Swal.fire({ text: {!! json_encode(session('success')) !!}, icon: "success", toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    @endif
    @if(session('error'))
    Swal.fire({ text: {!! json_encode(session('error')) !!}, icon: "error", toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    @endif
    @if(session('warning'))
    Swal.fire({ text: {!! json_encode(session('warning')) !!}, icon: "warning", toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
    @endif
  </script>
  @stack('scripts')
</body>
</html>

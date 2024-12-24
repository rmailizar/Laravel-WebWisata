<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Pariwisata | Dashboard</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/img/svg/logo.svg')}}" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  {{-- styles --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
</head>

<body>
<div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">Website</span>
                    <span class="logo-subtitle">Data Pariwisata</span>
                </div>
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active" href="{{ route('visitors.index')}}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
            </ul>
            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                <li>
                    <a href="{{ route('visitors.create')}}"><span class="icon edit" aria-hidden="true"></span>Tambah Pengunjung</a>
                </li>
                <li>
                    <a href="{{ route('visitors.statistik') }}">
                        <span class="icon category" aria-hidden="true"></span>Statistik Pengunjung
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture><source srcset="{{ asset('assets/img/avatar/avatar-illustrated-02.webp')}}" type="image/webp"><img src="{{ asset('assets/img/avatar/avatar-illustrated-02.png')}}" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">{{ auth()->user()->name }}</span>
                <span class="sidebar-user__subtitle">Employee</span>
            </div>
        </a>
    </div>
</aside>
    <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
        <div class="container main-nav">
          <div class="main-nav-start">

          </div>
          <div class="main-nav-end">
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
              <span class="sr-only">Toggle menu</span>
              <span class="icon menu-toggle--gray" aria-hidden="true"></span>
            </button>
            <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
              <span class="sr-only">Switch theme</span>
              <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
              <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
            </button>
            <div class="nav-user-wrapper">
              <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                <span class="sr-only">My profile</span>
                <span class="nav-user-img">
                  <picture><source srcset="{{ asset('assets/img/avatar/avatar-illustrated-02.webp') }}" type="image/webp"><img src="{{ asset('assets/img/avatar/avatar-illustrated-02.png')}}" alt="User name"></picture>
                </span>
              </button>
              <ul class="users-item-dropdown nav-user-dropdown dropdown">
                <li><a href="##">
                    <i data-feather="user" aria-hidden="true"></i>
                    <span>Profile</span>
                  </a></li>
                <li><a href="##">
                    <i data-feather="settings" aria-hidden="true"></i>
                    <span>Account settings</span>
                  </a></li>
                  <li><button class="btn">
                    <a class="danger" href="{{ route('logout')}}">
                    <i data-feather="log-out" aria-hidden="true"></i>
                    <span>Log out</span>
                    </a>
                    </button>
                  </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
    {{-- end Main Nav --}}
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">Dashboard</h2>
        <div class="row">
          <div class="col-lg-11">
            <div class="chart">
              <canvas id="myChart" aria-label="Site statistics" role="img"></canvas>
            </div>
            @yield('konten')
          </div>
        </div>
      </div>
    </main>
    <!-- ! Footer -->
    <footer class="footer">
        <div class="container footer--flex">
            <div class="footer-start">
            <p>2024 © Build with ❤ - <a href="elegant-dashboard.com" target="_blank"
                rel="noopener noreferrer">Kelompok 8</a></p>
            </div>
        </div>
    </footer>
  </div>
</div>
<!-- Chart library -->
<script src="{{ asset('assets/plugins/chart.min.js') }}"></script>
<!-- Icons library -->
<script src="{{ asset('assets/plugins/feather.min.js') }}"></script>
<!-- Custom scripts -->
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
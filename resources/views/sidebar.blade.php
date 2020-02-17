<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../">
        <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg
">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button href="" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </button>
            </form>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.html">
                <img src="../assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended cari" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item @yield('index') ">
            <a class="nav-link @yield('index')" href="../">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item @yield('datasiswa')">
            <a class="nav-link @yield('datasiswa')" href="{{ route('siswa.index') }}">
              <i class="fas fa-users text-yellow"></i> Data Siswa
            </a>
          </li>
          <li class="nav-item @yield('detailnilai')">
            <a class="nav-link @yield('detailnilai')" href="{{ route('nilai_siswa.index') }}">
              <i class="fas fa-file text-blue"></i> Detail Nilai
            </a>
          </li>
          @if (count($kelass)>0)
          <li class="nav-item @yield('ranking')">
            <a class="nav-link @yield('ranking')" href="{{ route('ranking.show',$kelass->first()->kelas) }}">
              <i class="fas fa-crown text-red"></i> Ranking Siswa
            </a>
          </li>
          @endif
          <li class="nav-item @yield('matapelajaran')">
            <a class="nav-link @yield('matapelajaran')" href="{{ route('mapel.index') }}">
              <i class="fas fa-book text-green"></i> Info MataPelajaran
            </a>
          </li>
          <li class="nav-item @yield('kelas')">
            <a class="nav-link @yield('kelas')" href="{{ route('kelas.index') }}">
              <i class="fas fa-home text-blue"></i> Info Kelas
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
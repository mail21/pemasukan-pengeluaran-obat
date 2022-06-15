<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ url('/') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @if (Auth::user()->role == 'superadmin')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ url('users') }}">
                <i class="bi bi-circle"></i><span>Users</span>
              </a>
            </li>
            <li>
              <a href="{{ url('obat') }}">
                <i class="bi bi-circle"></i><span>Obat</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      @endif
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('laporan-pemasukan') }}">
          <i class="bi bi-journal-text"></i>
          <span>Laporan Pemasukan</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('laporan-pengeluaran') }}">
          <i class="bi bi-journal-text"></i>
          <span>Laporan Pengeluaran</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('transaksi') }}">
          <i class="bi bi-envelope"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('logout') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

      {{-- <li class="nav-heading">Pages</li> --}}
    </ul>

  </aside><!-- End Sidebar-->
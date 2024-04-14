<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="info">
      <a href="#" class="d-block">Sistem Informasi RT Online</a>
    </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-header">Dashboard</li>
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Kegiatan Warga</li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'kerja_bakti')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'kerja_bakti')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-users"></i>
          <p>Kerja Bakti</p>
        </a>
      </li>
      <li class="nav-header">Keuangan</li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'keuangan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'keuangan')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-file-invoice"></i>
          <p>Laporan Keuangan</p>
        </a>
      </li>
      <li class="nav-header">Inventaris</li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'inventaris')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'inventaris')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-box"></i>
          <p>Daftar Inventaris</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'peminjaman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'peminjaman')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Daftar Peminjaman</p>
        </a>
      </li>
      <li class="nav-header">Pengumuman</li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'pengumuman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'pengumuman')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-bullhorn"></i>
          <p>Daftar Pengumuman</p>
        </a>
      </li>
      <li class="nav-header">Informasi Akun</li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'anggota')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'anggota')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-users"></i>
          <p>Daftar Anggota</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'akun')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-user"></i>
          <p>Akun Saya</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link {{ ($activeMenu == 'keluar')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'keluar')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Keluar</p>
        </a>
      </li>
    </ul>
  </nav>
</div>

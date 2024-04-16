<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="info">
      <a href="#" class="d-block" style="font-family: 'Nunito Sans', sans-serif; font-size: 25px; font-weight: bold; color: #424874;">
        Sistem Informasi<br>RT Online</a>    

    </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      @php
        $role = session('role');
      @endphp
      @switch($role)
      {{-- PENDUDUK --}}
        @case('penduduk')
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
          @break
          {{-- KETUA RT --}}
          @case('ketua_rt')
          <li class="nav-header">Dashboard</li>
          
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">Kependudukan</li>
          
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'data_rumah')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_rumah')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Data Rumah</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'data_kk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_kk')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-id-card"></i>
              <p>Data Kartu Keluarga</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'data_penduduk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_penduduk')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Data Penduduk</p>
            </a>
          </li>
          <li class="nav-header">Kegiatan Warga</li>
          
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'kerja_bakti')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'kerja_bakti')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Kerja Bakti</p>
            </a>
          </li>
          <li class="nav-header">Keuangan</li>
          
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'laporan_keuangan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'laporan_keuangan')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>Laporan Keuangan</p>
            </a>
          </li>
          <li class="nav-header">Inventaris</li>
          
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'daftar_inventaris')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'daftar_inventaris')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-box"></i>
              <p>Daftar Inventaris</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'daftar_peminjaman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'daftar_peminjaman')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Daftar Peminjaman</p>
            </a>
          </li>
          <li class="nav-header">Pengumuman</li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'kelola_pengumuman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'kelola_pengumuman')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>Kelola Pengumuman</p>
            </a>
          </li>
          <li class="nav-header">Informasi Akun</li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'akun')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-user"></i>
              <p>Akun Saya</p>
            </a>
          </li>
          @break
          {{-- SEKRETASRIS --}}
          @case('sekretaris')
          <li class="nav-header">Dashboard</li>
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">Kependudukan</li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'data_rumah')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_rumah')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Data Rumah</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'data_kk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_kk')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-id-card"></i>
              <p>Data Kartu Keluarga</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'data_penduduk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_penduduk')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Data Penduduk</p>
            </a>
          </li>
          <li class="nav-header">Informasi Akun</li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'akun_saya')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun_saya')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>Akun Saya</p>
            </a>
          </li>
          @break
          {{-- BENDAHARA --}}
          @case('bendahara')
          <li class="nav-header">Dashboard</li>
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">Keuangan</li>
          <li class="nav-item">
            <a href="{{ url('/pemasukan') }}" class="nav-link {{ ($activeMenu == 'pemasukan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'pemasukan')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>Pemasukan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/pengeluaran') }}" class="nav-link {{ ($activeMenu == 'pengeluaran')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'pengeluaran')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>Pengeluaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'laporan_keuangan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'laporan_keuangan')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>Laporan Keuangan</p>
            </a>
          </li>
          <li class="nav-header">Informasi Akun</li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'akun_saya')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun_saya')? 'background-color: #424874;' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>Akun Saya</p>
            </a>
          </li>
          @break
          @default
      @endswitch
      <li class="nav-item">
        <a href="{{ url('/login') }}" class="nav-link {{ ($activeMenu == 'keluar')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'keluar')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Keluar</p>
        </a>
      </li>
    </ul>
  </nav>
</div>

<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="info">
      <a href="#" class="d-block" style="font-family: 'Nunito Sans', sans-serif; font-size: 25px; font-weight: bold; color: #424874;">
        Sistem Informasi<br>RT Online</a>
        <a href="#" class="d-block" style="font-family: 'Nunito Sans', sans-serif; font-size: 20px; font-weight: ; color: #424874;">
          (jl.Candi Panggung <br>
          Gang 1B)</a><br>
    </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      {{-- php
        $role = Auth::user()->role;
      endphp --}}
      @php
      $role = session('role');
      @endphp
      @php
      $activeMenu = isset($activeMenu) ? $activeMenu : ''; // Setel dengan nilai default jika variabel belum didefinisikan
      @endphp

      @switch($role)
      {{-- PENDUDUK --}}
      @case('penduduk')
      <li class="nav-header">Dashboard</li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/dashboard') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/DaftarAnggota') }}" class="nav-link {{ ($activeMenu == 'DaftarAnggota')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'DaftarAnggota')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-users"></i>
          <p>Daftar Anggota</p>
        </a>
      </li>
      <li class="nav-header">Kegiatan Warga</li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/DaftarAnggota') }}" class="nav-link {{ ($activeMenu == 'DaftarAnggota')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'DaftarAnggota')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-users"></i>
          <p>Daftar Anggota</p>
        </a>
      </li>
      <li class="nav-header">Kerja Bakti</li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/mabac') }}" class="nav-link {{ ($activeMenu == 'mabac')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'mabac')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-people-carry"></i> 
          <p>Metode Mabac</p>
        </a>
        <a href="{{ url('/penduduk/maut') }}" class="nav-link {{ ($activeMenu == 'maut')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'maut')? 'background-color: #424874;' : '' }}">  <i class="nav-icon fas fa-people-carry"></i> 
          <p>Metode Maut</p>
        </a>
      </li>
      <li class="nav-header">Keuangan</li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/laporan_keuangan') }}" class="nav-link {{ ($activeMenu == 'keuangan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'keuangan')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-file-invoice"></i>
          <p>Laporan Keuangan</p>
        </a>
      </li>
      <li class="nav-header">Inventaris</li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/daftar_inventaris') }}" class="nav-link {{ ($activeMenu == 'inventaris')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'inventaris')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-box"></i>
          <p>Daftar Inventaris</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/peminjaman') }}" class="nav-link {{ ($activeMenu == 'peminjaman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'peminjaman')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Daftar Peminjaman</p>
        </a>
      </li>
      <li class="nav-header">Pengumuman</li>
      <li class="nav-item">
        <a href="{{ url('/penduduk/pengumuman') }}" class="nav-link {{ ($activeMenu == 'pengumuman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'pengumuman')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-bullhorn"></i>
          <p>Daftar Pengumuman</p>
        </a>
      </li>
      <li class="nav-header">Informasi Akun</li>
      
      <li class="nav-item">
        <a href="{{ url('/penduduk/akun') }}" class="nav-link {{ ($activeMenu == 'akun')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-user"></i>
          <p>Akun Saya</p>
        </a>
      </li>
      @break
      {{-- KETUA RT --}}
      @case('ketua_rt')
      <li class="nav-header">Dashboard</li>

      <li class="nav-item">
        <a href="{{ url('/ketuaRt/dashboard') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Kependudukan</li>

      <li class="nav-item">
        <a href="{{ url('/ketuaRt/data_rumah') }}" class="nav-link {{ ($activeMenu == 'data_rumah')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_rumah')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>Data Rumah</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/data_kk') }}" class="nav-link {{ ($activeMenu == 'data_kk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_kk')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-id-card"></i>
          <p>Data Kartu Keluarga</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/data_penduduk') }}" class="nav-link {{ ($activeMenu == 'data_penduduk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_penduduk')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Data Penduduk</p>
        </a>
      </li>
      <li class="nav-header">Kerja Bakti</li>

      <li class="nav-item">
        <a href="{{ url('/ketuaRt/kriteria') }}" class="nav-link {{ ($activeMenu == 'kriteria')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'kriteria')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Kriteria</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/alternatif') }}" class="nav-link {{ ($activeMenu == 'alternatif')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'alternatif')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Alternatif</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/maut') }}" class="nav-link {{ ($activeMenu == 'maut')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'maut')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>MAUT</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/mabac') }}" class="nav-link {{ ($activeMenu == 'mabac')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'mabac')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>MABAC</p>
        </a>
      </li>
      <li class="nav-header">Keuangan</li>

      <li class="nav-item">
        <a href="{{ url('/ketuaRt/laporanKeuangan') }}" class="nav-link {{ ($activeMenu == 'laporan_keuangan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'laporan_keuangan')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-file-invoice"></i>
          <p>Laporan Keuangan</p>
        </a>
      </li>
      <li class="nav-header">Inventaris</li>

      <li class="nav-item">
        <a href="{{ url('/ketuaRt/daftar_inventaris') }}" class="nav-link {{ ($activeMenu == 'inventaris')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'inventaris')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-box"></i>
          <p>Daftar Inventaris</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/daftar_peminjaman') }}" class="nav-link {{ ($activeMenu == 'daftar_peminjaman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'daftar_peminjaman')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Daftar Peminjaman</p>
        </a>
      </li>
      <li class="nav-header">Pengumuman</li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/kelola_pengumuman') }}" class="nav-link {{ ($activeMenu == 'kelola_pengumuman')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'kelola_pengumuman')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-bullhorn"></i>
          <p>Kelola Pengumuman</p>
        </a>
      </li>
      <li class="nav-header">Informasi Akun</li>
      <li class="nav-item">
        <a href="{{ url('/ketuaRt/akun') }}" class="nav-link {{ ($activeMenu == 'akun')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun')? 'background-color: #424874;' : '' }}"> <i class="nav-icon fas fa-user"></i>
          <p>Akun Saya</p>
        </a>
      </li>
      @break
      {{-- SEKRETASRIS --}}
      @case('sekretaris') 
      <li class="nav-header">Dashboard</li>
      <li class="nav-item">
        <a href="{{ url('/sekretaris/dashboard') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Kependudukan</li>
      <li class="nav-item">
        <a href="{{ url('/sekretaris/data_rumah') }}" class="nav-link {{ ($activeMenu == 'data_rumah')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_rumah')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>Data Rumah</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/sekretaris/data_kk') }}" class="nav-link {{ ($activeMenu == 'data_kk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_kk')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-id-card"></i>
          <p>Data Kartu Keluarga</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/sekretaris/data_penduduk') }}" class="nav-link {{ ($activeMenu == 'data_penduduk')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'data_penduduk')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Data Penduduk</p>
        </a>
      </li>
      <li class="nav-header">Informasi Akun</li>
      <li class="nav-item">
        <a href="{{ url('/sekretaris/akun') }}" class="nav-link {{ ($activeMenu == 'akun')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-user"></i>
          <p>Akun Saya</p>
        </a>
      </li>
      @break
      {{-- BENDAHARA --}}
      @case('bendahara')
      <li class="nav-header">Dashboard</li>
      <li class="nav-item">
        <a href="{{ url('bendahara/dashboardBendahara') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'dashboard')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Keuangan</li>
      <li class="nav-item">
        <a href="{{ url('bendahara/pemasukan') }}" class="nav-link {{ ($activeMenu == 'pemasukan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'pemasukan')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-money-bill-wave"></i>
          <p>Pemasukan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('bendahara/pengeluaran') }}" class="nav-link {{ ($activeMenu == 'pengeluaran')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'pengeluaran')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-money-bill-alt"></i>
          <p>Pengeluaran</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('bendahara/keuanganBendahara') }}" class="nav-link {{ ($activeMenu == 'laporan_keuangan')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'laporan_keuangan')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-file-invoice"></i>
          <p>Laporan Keuangan</p>
        </a>
      </li>
      <li class="nav-header">Paguyuban</li>
      <li class="nav-item">
        <a href="{{ url('bendahara/paguyuban') }}" class="nav-link {{ ($activeMenu == 'paguyuban')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'paguyuban')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-file-invoice"></i>
          <p>Paguyuban</p>
        </a>
      </li>
      <li class="nav-header">Informasi Akun</li>
      <li class="nav-item">
        <a href="{{ url('bendahara/akunBendahara') }}" class="nav-link {{ ($activeMenu == 'akun_saya')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'akun_saya')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-user"></i>
          <p>Akun Saya</p>
        </a>
      </li>
      @break
      @default
      @endswitch
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'keluar')? 'active' : '' }} rounded-pill" style="{{ ($activeMenu == 'keluar')? 'background-color: #424874;' : '' }}">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Keluar</p>
        </a>
      </li>
    </ul>
  </nav>
</div>
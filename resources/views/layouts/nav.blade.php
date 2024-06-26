<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{url('assets/images/logo-bpn.ico')}}" class="logo-icon" alt="logo icon" style="width: 75px; height:auto">
        </div>
        <div>
            <h4 class="logo-text">Admifin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('pegawai'))
        <li>
            <a href="/dashboard">
                <div class="parent-icon"><i class="bx bx-home"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @endif

        @role('admin')
        <li class="menu-label">Master Data</li>
        @endrole

        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('pegawai'))
        <li>
            <a href="/anggaran">
                <div class="parent-icon"><i class='bx bx-columns'></i></div>
                <div class="menu-title">Data Anggaran</div>
            </a>
        </li>
        @endif

        @role('admin')
        <li>
            <a href="/saldo">
                <div class="parent-icon"><i class='bx bx-dollar-circle'></i></div>
                <div class="menu-title">Saldo</div>
            </a>
        </li>
        @endrole

        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('pegawai'))
        <li>
            <a href="/kategori">
                <div class="parent-icon"><i class='bx bx-collection'></i></div>
                <div class="menu-title">Alokasi Dana</div>
            </a>
        </li>
        @endif

        @if(auth()->user()->hasRole('admin'))
        <li class="menu-label">Pencatatan</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-coin-stack'></i></div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li><a href="/pemasukan"><i class="bx bx-right-arrow-alt"></i>Pemasukan</a></li>
                <li><a href="/pengeluaran"><i class="bx bx-right-arrow-alt"></i>Pengeluaran</a></li>
            </ul>
        </li>
        <li>
            <a href="/kasbon">
                <div class="parent-icon"><i class='bx bx-note'></i></div>
                <div class="menu-title">Kasbon</div>
            </a>
        </li>
        <!-- <li>
            <a href="/tagihan">
                <div class="parent-icon"><i class='bx bx-bell'></i>
                </div>
                <div class="menu-title">Pengingat Tagihan</div>
            </a>
        </li> -->
        @endif


        @role('admin')
        <li class="menu-label">Kelola</li>
        @endrole

        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('pegawai'))
        <li>
            <a href="/pengajuan">
                <div class="parent-icon"><i class='bx bx-money'></i></div>
                <div class="menu-title">Pengajuan Dana</div>
            </a>
        </li>
        @endif

        @role('admin|pegawai')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-file'></i></div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li><a href="/laporan-pemasukan"><i class="bx bx-right-arrow-alt"></i>Pemasukan</a></li>
                <li><a href="/laporan-pengeluaran"><i class="bx bx-right-arrow-alt"></i>Pengeluaran</a></li>
                <li><a href="/laporan"><i class="bx bx-right-arrow-alt"></i>Laporan Keuangan</a></li>
            </ul>
        </li>
        <!-- <li>
            <a href="/laporan">
                <div class="parent-icon"><i class='bx bx-file'></i></div>
                <div class="menu-title">Laporan</div>
            </a>
        </li> -->
        @endrole

        @role('admin')
        <li>
            <a href="/user">
                <div class="parent-icon"><i class='bx bx-user'></i></div>
                <div class="menu-title">User</div>
            </a>
        </li>
        @endrole
    </ul>
    <!--end navigation-->
</div>
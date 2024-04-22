<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{url('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admifin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/dashboard">
                <div class="parent-icon"><i class="bx bx-home"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Master Data</li>

        <!-- @role('admin|pegawai')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-line-chart'></i>
                </div>
                <div class="menu-title">Anggaran</div>
            </a>
            <ul>
                <li> <a href="/anggaran"><i class="bx bx-right-arrow-alt"></i>Data Anggaran</a>
                </li>
                <li> <a href="/pengajuan"><i class="bx bx-right-arrow-alt"></i>Pengajuan</a>
                </li>
            </ul>
        </li>
        @endrole -->

        @role('admin')
        <li>
            <a href="/saldo">
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Saldo</div>
            </a>
        </li>
        @endrole
        
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('pegawai'))
        <li>
            <a href="/anggaran">
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Anggaran</div>
            </a>
        </li>
        <li>
            <a href="/kategori">
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Kategori</div>
            </a>
        </li>
        @endif

        @role('admin')
        <li>
            <a href="/jenisakun">
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Jenis Akun</div>
            </a>
        </li>
        @endrole

        @if(auth()->user()->hasRole('admin'))
        <li class="menu-label">Pencatatan</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-dollar-circle'></i></div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li><a href="/pemasukan"><i class="bx bx-right-arrow-alt"></i>Pemasukan</a></li>
                <li><a href="/pengeluaran"><i class="bx bx-right-arrow-alt"></i>Pengeluaran</a></li>
            </ul>
        </li>
        @endif
        <!-- <li>
            <a href="/pengingat">
                <div class="parent-icon"><i class='bx bx-bell'></i>
                </div>
                <div class="menu-title">Pengingat</div>
            </a>
        </li> -->
        <!-- <li>
            <a href="/laporan">
                <div class="parent-icon"><i class='bx bx-folder'></i>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
        </li> -->

        @role('admin')
        <li class="menu-label">Pengaturan</li>
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
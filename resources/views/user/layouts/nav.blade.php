<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ url('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
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
            <a href="{{ url('home') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-line-chart'></i>
                </div>
                <div class="menu-title">Anggaran</div>
            </a>
            <ul>
                <li> <a href="{{ url('app-emailbox') }}"><i class="bx bx-right-arrow-alt"></i>Data Anggaran</a>
                </li>
                <li> <a href="{{ url('app-chat-box') }}"><i class="bx bx-right-arrow-alt"></i>Pengajuan</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ url('user-profile') }}">
                <div class="parent-icon"><i class='bx bx-menu'></i>
                </div>
                <div class="menu-title">Kategori</div>
            </a>
        </li>
        <li>
            <a href="{{ url('widgets') }}">
                <div class="parent-icon"><i class='bx bx-folder'></i>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>